@extends('layouts.admin')

@section('title', 'Edit Garden')
    
@section('admin_content')

	<div class="container-fluid px-4">
	   <div class="row justify-content-center mt-5">
	        <div class="col-xl-5 col-md-6">

				<div class="row">
			        <div class="col-xl-4">
			            <h3 class="mt-4">Garden Edit</h3>
			        </div>
			        <div class="col-xl-4">
			            
			        </div>
			        <div class="col-xl-4 text-end">
			            <a href="{{ route('admin.garden.index') }}" class="mt-4 btn btn-sm btn-danger">Back</a>
			        </div>
			    </div>

			    @if(Session::has('error'))
				<div class="row">
			        <div class="col-xl-12">
	                    <div class="alert alert-danger mt-4" role="alert">
						  {{ Session::get('error') }}
						</div>
			        </div>
			    </div>
				@endif

	            <div class="card text-white mb-4">
		            <form method="POST" action="{{ route('admin.garden.update', $garden->id) }}" enctype="multipart/form-data">
		            	@method('put')
		                @csrf

		                <div class="card-body">
						  <div class="form-group mb-3">
						    <label for="garden_name_en" class="text-dark form-label">Garden Name English <strong class="text-danger">*</strong></label>
						    <input type="text" value="{{ $garden->garden_name_en }}" class="form-control" id="garden_name_en" name="garden_name_en">

						    @error('garden_name_en')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  <div class="form-group mb-3">
						    <label for="garden_name_bn" class="text-dark form-label">Garden Name Bangla <strong class="text-danger">*</strong></label>
						    <input type="text" value="{{ $garden->garden_name_bn }}" class="form-control" id="garden_name_bn" name="garden_name_bn">

						    @error('garden_name_bn')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  <div class="form-group mb-3">
						    <label for="garden_location_en" class="text-dark form-label">Garden Location English <strong class="text-danger">*</strong></label>
						    <input type="text" value="{{ $garden->garden_location_en }}" class="form-control" id="garden_location_en" name="garden_location_en">

						    @error('garden_location_en')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  <div class="form-group mb-3">
						    <label for="garden_location_bn" class="text-dark form-label">Garden Location Bangla <strong class="text-danger">*</strong></label>
						    <input type="text" value="{{ $garden->garden_location_bn }}" class="form-control" id="garden_location_bn" name="garden_location_bn">

						    @error('garden_location_bn')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  @isset($garden->garden_image)
						  <div class="form-group mb-3">
						    <label  class="text-dark form-label">Existing Garden Image</label><br>
						    <img src="{{ asset('storage/'. $garden->garden_image) }}" height="150" width="300" alt="{{ $garden->garden_name_en }}" />
						  </div>
						  @endisset

						  <div class="form-group mb-3">
						    <label for="garden_image" class="text-dark form-label">Garden Image <strong class="text-danger">*</strong></label>
						    <input type="file" class="form-control garden_image" id="garden_image" name="garden_image">
						    <input type="hidden" name="old_garden_image" value="{{ $garden->garden_image }}">

						    @error('garden_image')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  <div class="form-group">
						    <label for="status" class="text-dark form-label">Status </label>
						    <select name="status" id="status" class="form-control">
						    	<option disabled selected>Select One</option>
						    	<option {{ $garden->status==1?'selected':'' }} value="1">Active</option>
						    	<option {{ $garden->status==0?'selected':'' }} value="0">Inactive</option>
						    </select>
						  </div>
		                </div>

					  	<div class="card-footer">
					  		<a href="{{ route('admin.garden.index') }}" class="btn btn-danger">Cancel</a>
					  		<button type="submit" class="btn btn-primary">Submit</button>
					  	</div>
					</form>
	            </div>
	        </div>
	    </div>
	</div>

@endsection

@push('script')
<script type="text/javascript">
	$(document).ready(function () {
		$('.garden_image').dropify();
	});
</script>
@endpush