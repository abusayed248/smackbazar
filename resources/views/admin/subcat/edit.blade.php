@extends('layouts.admin')

@section('title', 'Edit Sub-Category')
    
@section('admin_content')

	<div class="container-fluid px-4">
	   <div class="row justify-content-center mt-5">
	        <div class="col-xl-6 col-md-6">

				<div class="row">
			        <div class="col-xl-4">
			            <h3 class="mt-4">Sub-Category Edit</h3>
			        </div>
			        <div class="col-xl-4">

			        </div>
			        <div class="col-xl-4 text-end">
			            <a href="{{ route('admin.subcat.index') }}" class="mt-4 btn btn-sm btn-danger">Back</a>
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
		            <form method="POST" action="{{ route('admin.subcat.update', $subcat->id) }}">
		            	@method('put')
		                @csrf

		                <div class="card-body">
							<div class="form-group mb-3">
								<label for="cat_id" class="text-dark form-label">Category<strong class="text-danger">*</strong></label>
								<select name="cat_id" id="cat_id" class="form-control">
									<option disabled selected>Select One</option>
									@foreach($categories as $category)
									<option class="text-primary" {{ $subcat->cat_id==$category->id?'selected':'' }} value="{{ $category->id }}">{{ $category->cat_name_en }}||{{ $category->cat_name_bn }}</option>
									@endforeach
								</select>

								@error('subcat_name_en')
								    <strong class="text-danger">
								        <strong>{{ $message }}</strong>
								    </strong>
								@enderror
							</div>

							<div class="form-group mb-3">
							<label for="subcat_name_en" class="text-dark form-label">Sub-Category Name English <strong class="text-danger">*</strong></label>
							<input type="text" class="form-control" value="{{ $subcat->subcat_name_en }}" id="subcat_name_en" name="subcat_name_en">

							@error('subcat_name_en')
							    <strong class="text-danger">
							        <strong>{{ $message }}</strong>
							    </strong>
							@enderror
							</div>

							<div class="form-group">
							<label for="subcat_name_bn" class="text-dark form-label">Sub-Category Name Bangla <strong class="text-danger">*</strong></label>
							<input type="text" value="{{ $subcat->subcat_name_bn }}" class="form-control" id="subcat_name_bn" name="subcat_name_bn">

							@error('subcat_name_bn')
							    <strong class="text-danger">
							        <strong>{{ $message }}</strong>
							    </strong>
							@enderror
							</div>

							<div class="form-group">
							<label for="status" class="text-dark form-label">Status <strong class="text-danger">*</strong></label>
							<select name="status" id="status" class="form-control">
								<option disabled selected>Select One</option>
								<option {{ $subcat->status==true?'selected':'' }} value="1">Active</option>
								<option {{ $subcat->status==false?'selected':'' }} value="0">Inactive</option>
							</select>
							</div>
						</div>

						<div class="card-footer">
							<a href="{{ route('admin.subcat.index') }}" class="btn btn-danger">Cancel</a>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
	            </div>
	        </div>
	    </div>
	</div>