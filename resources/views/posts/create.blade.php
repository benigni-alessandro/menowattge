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
                            <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                 @method('POST')
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="thumb" class="form-label"><b>Upload an Image</b></label>
                                    <input type="file" class="form-control-file @error('thumb') is-invalid @enderror" id="thumb" name="thumb" value="" >
                                </div>
                                <div class="form-floating">
                                    <label for="content">Content</label>
                                    <textarea type="text" name="content" class="form-control" style="height:80px;"></textarea>
                                </div>  
                                <button type="submit" class="btn btn-primary">Save</button>                              
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection