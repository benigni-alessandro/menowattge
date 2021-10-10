@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Posts</h3>
        </div>
      
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    @can('crear-post')
                    <a class="btn btn-warning" href="{{route('posts.create')}}">New Post</a>
                    @endcan
                    </div>
                    @foreach($posts as $post)
                    <div class="card post">
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
                            <img src="{{ asset('storage/' . $usuario->photo)}}"      
                            class="user_image">
                            <span><strong>{{$usuario->name}}</strong></span>
                        @endif

                        </div>
                        <div class="title-post">
                            <h3>{{ $post->title }}</h3>
                        </div>
                           <div class="card-body" style="max-height:500px;"> 
                                <div class="primero">
                                    <?php
                                    Storage::disk('s3')->files('$post->thumb');
                                    ?>
                                    <img class="" style="width: 100%; max-width: 320px; height: auto; max-height:200px;"
                                    src="{{Storage::disk('s3')->response($post->thumb)}}" 
                                    alt="immagine non disponibile"> 
                                </div>
                                <div class="segundo">
                                   <p class="card-text">{{ $post->content }}</p>
                                </div>                                 
                                
                            </div>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">                                        
                                @csrf
                                @method('DELETE')
                                @can('borrar-post')
                                <button type="submit" class="btn btn-danger">Borrar</button>
                                @endcan
                            </form>  
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection