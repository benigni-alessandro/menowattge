@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Posts</h3>
        </div>
      
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                @can('crear-post')
                    <a class="btn btn-warning" href="{{route('posts.create')}}">New Post</a>
                @endcan
                @foreach($posts as $post)
                    <div class="card post">
                        <div class="blog-post">
                            <div class="blog-post-img">
                                <img class="" 
                                src="{{$post->thumb}}" 
                                alt="immagine non disponibile">
                            </div>
                            <div class="blog-post-informations">
                                <h1 class="title-post">{{ $post->title }}</h1>
                                <p class="post-text">{{ $post->content }}</p>
                            </div>
                            
                        </div>
                        <div style="display: flex; justify-content: center;">
                            @can('borrar-post')
                             <form  action="{{ route('posts.destroy', $post->id)}}" method="POST">                                        
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><span class="only-icon">Eliminar </span><i class="fas fa-trash"></i></button>  
                            </form>  
                            <button class="btn btn-info" href="{{route('posts.show', $post->id)}}">Read more ></button>
                            @endcan
                        </div>
                        <div class="creator">
                            <?php
                            $user_identity = $post->user_id;                    
                            $usuari = DB::table('users')
                                ->where('id', '=', $user_identity)
                                ->get();
                            foreach($usuari as $usuario){
                                $immagine = $usuario->photo;
                            }
                            ?>
                            @if(Auth::user()->photo)
                            <img src="{{Auth::user()->photo}}"      
                            class="user_image">
                            <span><strong>{{$usuario->name}}</strong></span>
                            @endif
                        </div>
                    @endforeach 
                </div>
            </div>
        </div>
    </section>
@endsection



