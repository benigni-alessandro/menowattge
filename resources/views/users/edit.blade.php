@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Edit User</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                <h3>Error on creation</h3>
                                @foreach($errors->all() as $error)
                                <p class="badge badge-danger">{{$error}}</p>
                                @endforeach
                            </div>
                            @endif

                            {!! Form::model($user, ['method'=>'PUT', 'route' => ['users.update', $user->id], 'enctype' => 'multipart/form-data']) !!}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        {!! Form::text('name', null, array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        {!! Form::text('email', null, array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="photo" class="form-label"><b>Image Profile</b></label>
                                        <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo', $user->photo) }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="state" class="form-label"><b>State</b></label>
                                        <input type="state" class="form-control-file @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state', $user->state) }}" >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <?php
                                        use Spatie\Permission\Models\Role;  
                                        $id = Auth::user()->id;          
                                        $user = User::find($id);
                                        if($id != 1) {
                                            $roles = DB::table('roles')
                                                         ->where('id', '!=', 1)
                                                         ->pluck('name', 'name')->all();
                                        } else{
                                            $roles = DB::table('roles')->pluck('name', 'name')->all();
                                        }
                                                         
                                        $userRole = $user->roles->pluck('name','name')->all();
                                        
                                        ?>
                                        <label for="name">Role</label>
                                        {!! Form::select('roles[]', $roles, [], array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection