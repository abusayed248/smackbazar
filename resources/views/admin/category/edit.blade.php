@extends('layouts.admin')

@section('title', 'Category Edit')
    
@section('admin_content')

	<div class="container-fluid px-4">
	   <div class="row justify-content-center mt-5">
	        <div class="col-xl-5 col-md-6">

				<div class="row">
			        <div class="col-xl-4">
			            <h3 class="mt-4">Category Edit</h3>
			        </div>
			        <div class="col-xl-4">
			            
			        </div>
			        <div class="col-xl-4 text-end">
			            <a href="{{ route('admin.category.index') }}" class="mt-4 btn btn-sm btn-danger">Back</a>
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
		            <form method="POST" action="{{ route('admin.category.update', $category->id) }}">
		            	@method('put')
		                @csrf

		                <div class="card-body">
						  <div class="form-group mb-3">
						    <label for="cat_name_en" class="text-dark form-label">Category Name English <strong class="text-danger">*</strong></label>
						    <input type="text" class="form-control" id="cat_name_en" value="{{ $category->cat_name_en }}" name="cat_name_en">

						    @error('cat_name_en')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  <div class="form-group">
						    <label for="cat_name_bn" class="text-dark form-label">Category Name Bangla <strong class="text-danger">*</strong></label>
						    <input type="text" class="form-control" id="cat_name_bn" value="{{ $category->cat_name_bn }}" name="cat_name_bn">

						    @error('cat_name_bn')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>

						  <div class="form-group">
						    <label for="status" class="text-dark form-label">Status <strong class="text-danger">*</strong></label>
						    <select name="status" id="status" class="form-control">
						    	<option disabled selected>Select One</option>
						    	<option {{ $category->status==true?'selected':'' }} value="1">Active</option>
						    	<option {{ $category->status==false?'selected':'' }} value="0">Inactive</option>
						    </select>

						    @error('status')
	                            <strong class="text-danger">
	                                <strong>{{ $message }}</strong>
	                            </strong>
	                        @enderror
						  </div>
		                </div>

					  	<div class="card-footer">
					  		<a href="{{ route('admin.category.index') }}" class="btn btn-danger">Cancel</a>
					  		<button type="submit" class="btn btn-primary">Submit</button>
					  	</div>
					</form>
	            </div>
	        </div>
	    </div>
	</div>