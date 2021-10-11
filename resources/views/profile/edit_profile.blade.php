<div id="EditProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
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

                            {!! Form::model( Auth::user(), ['method'=>'PUT', 'route' => ['users.update', Auth::user()->id], 'enctype' => 'multipart/form-data']) !!}
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
                                        <label for="photo" class="form-label"><b>Image Profile</b></label>
                                        <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo',  Auth::user()->photo) }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="state" class="form-label"><b>State</b></label>
                                        <input type="state" class="form-control-file @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state',  Auth::user()->state) }}" >
                                    </div>
                                </div>
                                <div class="col-12" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Role</label>
                                        <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photo" name="roles" value="{{ old('photo',  Auth::user()->roles) }}">
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
    </div>
</div>



