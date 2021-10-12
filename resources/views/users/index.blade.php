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
                            <table class="table table-striped mt-2" style="max-width: 100%; overflow-x: auto">
                                <thead style="background-color: #4dd132d0;">
                                <th style="color: white;">Name</th>
                                <th style="color: white;" class="dis-none">Email</th>
                                <th style="color: white;">Rol</th>
                                <th style="color: white;">Buttons</th>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td class="dis-none">{{$user->email}}</td>
                                        <td>
                                          @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $rolName)
                                            <span>{{$rolName}}</span>
                                                
                                            @endforeach
                                          @endif
                                        </td>
                                        <td>
                                        @can('crear-user')
                                        <button class="btn btn-info" href="{{route('users.edit', $user->id)}}"><span class="only-icon">Edit </span><i class="fas fa-user-edit"></i></button>    
                                        {!! Form::open(['method'=>'DELETE', 'route' => ['users.destroy', $user->id], 'style'=>'display:inline']) !!}
                                        <button type="submit" class="btn btn-danger"><span class="only-icon">Eliminar </span><i class="fas fa-trash"></i></button>
                                        {!! Form::close() !!}
                                        </td>
                                        @endcan
                                       
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