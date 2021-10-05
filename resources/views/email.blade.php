@extends('layouts.app')

@section('content')
@can('borrar-user')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Send a Mail</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <form action="{{ route('mailSend') }}" method="post" enctype="multipart/form-data">
                            @csrf
					<div class="form-group">
						<label for="inputSubject">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter subject">
                        @error('subject')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="inputMessage">Message</label>
                        <textarea name="content" rows="5" class="form-control" placeholder="Enter Your Message"></textarea>
                        @error('content')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
					</div>
                    <div class="mb-3">
                        <label for="attachment" class="form-label">File upload</label>
                        <input class="form-control" type="file" id="attachment" name="attachment">
                    </div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send</button>
					</div>            
				</form>
                  
                    </div>
                </div>
            </div>
        </div>
    </section>
@endcan
@endsection