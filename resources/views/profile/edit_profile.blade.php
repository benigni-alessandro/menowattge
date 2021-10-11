<div id="EditProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            {!! Form::model(Auth::user(), ['method'=>'PUT', 'route' => ['users.update', Auth::user()->id], 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="name">Name</label>
                            {!! Form::text('name', null, array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        <div class="form-group col-sm-6 d-flex">
                       
                                        <label for="photo" class="form-label"><b>Image Profile</b></label>
                                        <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo', $user->photo) }}">
                             
                                
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                        <label for="state" class="control-label">State</label>
                        <input type="state" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ Auth::user()->state }}">
                        @error('state')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Email:</label><span class="required">*</span>
                            <input type="text" name="email" id="email" class="form-control" required tabindex="3" disabled>
                        </div>
                    </div>
                    <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Save
                     </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>



