@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-rol')
                                <a class="btn btn-warning" href="{{route('posts.create')}}">New Post</a>
                            @endcan
                            
                            @foreach($posts as $post)
                            <div class="card" style="">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h2>{ $post->title }}</h2>
                                    <small style="display: none;">{{ $post->id }}</small>
                                    <p class="card-text">{{ $post->content }}</p>
                                </div>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">                                        
                                    @can('editar-post')
                                    <a class="btn btn-info" href="{{ route('posts.edit', $post->id) }}">Editar</a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')
                                    @can('borrar-post')
                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                    @endcan
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection