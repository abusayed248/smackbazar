@extends('layouts.admin')

@section('title', 'Edit Caste')
    
@section('admin_content')

	<div class="container-fluid px-4">
	   <div class="row justify-content-center mt-5">
	        <div class="col-xl-5 col-md-6">

				<div class="row">
			        <div class="col-xl-4">
			            <h3 class="mt-4">Caste Edit</h3>
			        </div>
			        <div class="col-xl-4">
			            
			        </div>
			        <div class="col-xl-4 text-end">
			            <a href="{{ route('admin.caste.index') }}" class="mt-4 btn btn-sm btn-danger">Back</a>
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
		            <form method="POST" action="{{ route('admin.caste.update', $caste->id) }}" enctype="multipart/form-data">
		            	@method('put')
		                @csrf

		                <div class="card-body">
						  <div class="form-group mb-3">
						    <label for="caste_name_en" class="text-dark form-label">Caste Name English <strong class="text-danger">*</strong></label>
						    <input type="text" value="{{ $caste->caste_name_en }}" class="form-control" id="caste_name_en" name="caste_name_en">

						    @error('caste_name_en')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  <div class="form-group mb-3">
						    <label for="caste_name_bn" class="text-dark form-label">Caste Name Bangla <strong class="text-danger">*</strong></label>
						    <input type="text" value="{{ $caste->caste_name_bn }}" class="form-control" id="caste_name_bn" name="caste_name_bn">

						    @error('caste_name_bn')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  @isset($caste->caste_image)
						  <div class="form-group mb-3">
						    <label class="text-dark form-label">Existing Caste Image</label><br>
						    <img src="{{ asset('storage/'.$caste->caste_image) }}" height="160" width="200" alt="" />
						  </div>
						  @endisset

						  <div class="form-group mb-3">
						    <label for="caste_image" class="text-dark form-label">Caste Image <strong class="text-danger">*</strong></label>
						    <input type="file" class="form-control caste_image" id="caste_image" name="caste_image">
						    <input type="hidden" name="old_caste_image" value="{{ $caste->caste_image }}">

						    @error('caste_image')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  <div class="form-group">
						    <label for="status" class="text-dark form-label">Status </label>
						    <select name="status" id="status" class="form-control">
						    	<option disabled selected>Select One</option>
						    	<option {{ $caste->status==1?'selected':'' }} value="1">Active</option>
						    	<option {{ $caste->status==0?'selected':'' }} value="0">Inactive</option>
						    </select>
						  </div>
		                </div>

					  	<div class="card-footer">
					  		<a href="{{ route('admin.caste.index') }}" class="btn btn-danger">Cancel</a>
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
		$('.caste_image').dropify();
	});
</script>
@endpush