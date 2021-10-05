@extends('layouts.app')

@section('content')
@can('crear-rol')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Create a Role</h3>
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

                            {!! Form::open(array('route'=>'roles.store', 'method'=>'POST')) !!}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Name of Role</label>
                                        {!! Form::text('name', null, array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Permissions of role</label>
                                        @foreach($permission as $value)
                                        <label>
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class'=>'name')) }}
                                            {{ $value->name }}
                                        </label>
                                        @endforeach
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
@endcan
@endsection