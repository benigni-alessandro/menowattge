@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Users</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Users</h3>
                            <a class="btn btn-warning" href="{{route('users.create')}}">New</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                <th style="color: white;">Number</th>
                                <th style="color: white;">Name</th>
                                <th style="color: white;">Email</th>
                                <th style="color: white;">Rol</th>
                                <th style="color: white;">Buttons</th>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                          @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $rolName)
                                            <span>{{$rolName}}</span>
                                                
                                            @endforeach
                                          @endif
                                        </td>
                                        <td>
                                        <a class="btn btn-info" href="{{route('users.edit', $user->id)}}">Edit</a>    
                                        {!! Form::open(['method'=>'DELETE', 'route' => ['users.destroy', $user->id], 'style'=>'display:inline']) !!}
                                            {!! Form::submit('Eliminar', ['class'=>'btn btn-danger'])!!}
                                        {!! Form::close() !!}
                                        </td>
                                       
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection