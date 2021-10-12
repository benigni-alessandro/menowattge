@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Create a User</h3>
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

                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">Full Name:</label><span
                                    class="text-danger">*</span>
                            <input id="firstName" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name"
                                   tabindex="1" placeholder="Enter Full Name" value="{{ old('name') }}"
                                   autofocus required>
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:</label><span
                                    class="text-danger">*</span>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="Enter Email address" name="email" tabindex="1"
                                   value="{{ old('email') }}"
                                   required autofocus>
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="control-label">Password
                                :</label><span
                                    class="text-danger">*</span>
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                   placeholder="Set account password" name="password" tabindex="2" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation"
                                   class="control-label">Confirm Password:</label><span
                                    class="text-danger">*</span>
                            <input id="password_confirmation" type="password" placeholder="Confirm account password"
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}"
                                   name="password_confirmation" tabindex="2">
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <?php
                        use Spatie\Permission\Models\Role;
                        $roles = DB::table('roles')
                         ->where('id', '!=', 1)
                         ->pluck('name', 'name')->all();
                         ?>
                            {!! Form::select('roles[]', $roles, [], array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="state" class="control-label">State</label>
                        <input type="state" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="" >
                        @error('state')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="photo" class="control-labeò">Image Profile</label>
                        <input type="file" class="form-control form-control-file @error('photo') is-invalid @enderror" id="photo" name="photo" value="" >
                        @error('photo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    </div>
                    
                   
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Register
                            </button>
                        </div>
                    </div>
                </div>
            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection