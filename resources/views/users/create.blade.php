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

                            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">

                            
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
                                        <label for="name">Password</label>
                                        {!! Form::password('password', array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Confirm password</label>
                                        {!! Form::password('confirm-password', array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Role</label>
                                        {!! Form::select('roles[]', $roles, [], array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                         <label for="photo" class="control-labeò">Image Profile</label>
                                        <input type="file" class="form-control form-control-file @error('photo') is-invalid @enderror" id="photo" name="photo" value="" >
                                        @error('photo')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
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