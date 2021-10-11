<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'state'=>'nullable',
            'photo'=>'image|max:6000|nullable',
        ]);
        $data = $request->all();
        if ($data['photo']) {
            $file = $data['photo'];
            $path = $request->file('photo')->store('images', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $immagine = [
                'filename'=>basename($path),
                'url'=>Storage::disk('s3')->url($path)
            ];
        }
        $data['password'] = Hash::make($input['password']);
        $post->photo = $immagine['url'];
        $user = User::create($data);
        $user->assignRole($request->$data['roles']);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if($id != 1) {
            $roles = DB::table('roles')
                         ->where('id', '!=', 1)
                         ->pluck('name', 'name')->all();
        } else{
            $roles = DB::table('roles')->pluck('name', 'name')->all();
        }
                         
        $userRole = $user->roles->pluck('name','name')->all();
        dd($user);
        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'nullable',
            'state'=>'nullable',
            'photo'=>'image|max:6000|nullable',
        ]);
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        $user = User::find($id);
        if (array_key_exists('photo', $input)) {
            $file = $input['photo'];
            $path = $request->file('photo')->store('images', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $immagine = [
                'filename'=>basename($path),
                'url'=>Storage::disk('s3')->url($path)
            ];
            $input['photo'] = $immagine['url'];
        }
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $user = User::find($id);

        if ($user)  {
            if ($user->delete()){
                 DB::statement('ALTER TABLE users AUTO_INCREMENT = '.(count(User::all())+1).';');
                    }   
            }
        $newid = DB::table('model_has_roles')
                         ->where('model_id', $id);
        $newid->delete();
        return redirect()->route('users.index');
    }
}
