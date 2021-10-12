@extends('layouts.app')

@section('content')
@can('borrar-rol')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Rols</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        @can('crear-rol')
                            <a class="btn btn-warning" href="{{route('roles.create')}}">New</a>
                        @endcan
                        <table class="table table-striped mt-2">
                            <thead style="background-color: #4dd132d0;">
                                <th style="color: white;">Role</th>
                                <th style="color: white;">Actions</th>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>
                                        {{$role->name}}
                                    </td>
                                    <td>
                                        @if('editar-rol')
                                            <a class="btn btn-primary" href="{{route('roles.edit', $role->id)}}"><span class="only-icon">Edit </span><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('borrar-rol')
                                        {!! Form::open(['method'=>'DELETE', 'route' => ['roles.destroy', $role->id], 'style'=>'display:inline']) !!}
                                        <button type="submit" class="btn btn-danger"><span class="only-icon">Eliminar </span><i class="fas fa-trash"></i></button>
                                        {!! Form::close() !!}
                                        @endcan
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
@endcan
@endsection