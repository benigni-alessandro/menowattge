<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use File;
use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function mailView()
    {
        return view('email');
    }

    public function mailSend(Request $request)
    {
        
        $clienti=[];
        $clienti = DB::table('model_has_roles')
            ->select('role_id', 'model_id')
            ->where('role_id', '=', 15)->get();
        
        $clientindex = [];
        foreach($clienti as $cliente => $index){
            array_push($clientindex, $index);
        }

        $path = public_path('uploads');
        $attachment = $request->file('attachment');
        $name = time().'.'.$attachment->getClientOriginalExtension();;
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $attachment->move($path, $name);

        $filename = $path.'/'.$name;

        

        // $data = $request->all();
        // $fileupload = Storage::put('uploads', $data['file']);
        

        foreach($clientindex as $client => $value){
            $daticliente = User::find($value->model_id);
            $datamessage= [
                'subject' => $request->subject,
                'name' => $daticliente->name,
                'email' => $daticliente->email,
                'content' => $request->content,
                
              ];
              
            
            //   Mail::send('email-template', $datamessage, function($message) use ($datamessage, $fileupload) {
            //     $message->to($datamessage['email'])
            //     ->subject($datamessage['subject'])->from('alebenigni002@gmail.com');
            //   });
            dd($filename);
            Mail::to($datamessage['email'])->send(new Notification($filename, $datamessage));
           
              
               
        }
        return back()->with(['message' => 'Email successfully sent!']);
    }
}
