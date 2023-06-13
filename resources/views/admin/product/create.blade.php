@extends('layouts.admin')

@section('title', 'Create Product')
    
@section('admin_content')

	<div class="container-fluid px-4">
	   <div class="row justify-content-center mt-2">
	        <div class="col-xl-12 col-md-6">

				<div class="row">
			        <div class="col-xl-4">
			            <h3 class="mt-4">Product Create</h3>
			        </div>
			        <div class="col-xl-4">
			            
			        </div>
			        <div class="col-xl-4 text-end">
			            <a href="{{ route('admin.product.index') }}" class="mt-4 btn btn-sm btn-danger">Back</a>
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
		            <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
		                @csrf

		                <div class="row">
		                	<div class="col-md-8">
		                		<div class="card-body">
									<div class="row mb-3">
										<div class="form-group col-md-6">
											<label for="p_name_en" class="text-dark form-label">Product Name English <strong class="text-danger">*</strong></label>
											<input type="text" value="{{ old('p_name_en') }}" class="form-control" id="p_name_en" name="p_name_en">

											@error('p_name_en')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>

										<div class="form-group col-md-6">
											<label for="p_name_bn" class="text-dark form-label">Product Name Bangla <strong class="text-danger">*</strong></label>
											<input type="text" value="{{ old('p_name_bn') }}" class="form-control" id="p_name_bn" name="p_name_bn">

											@error('p_name_bn')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>
									</div>

									<div class="row mb-3">
										<div class="form-group col-md-6">
											<label for="p_code" class="text-dark form-label">Product Code <strong class="text-danger">*</strong></label>
											<input type="text" value="{{ old('p_code') }}" class="form-control" id="p_code" name="p_code">

											@error('p_code')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>

										<div class="form-group col-md-6">
											<label for="subcat_id" class="text-dark form-label">Category/Subcategory <strong class="text-danger">*</strong></label>
											<select class="form-control" id="subcat_id" name="subcat_id">
												@foreach($categories as $category)
												@php
												$subcats = \App\Models\Subcat::where('cat_id', '=', $category->id)->get();
												@endphp
												<option disabled class="text-danger">{{ $category->cat_name_en }}|{{ $category->cat_name_bn }}</option>
													@foreach($subcats as $subcat)
													<option value="{{ $subcat->id }}">-- {{ $subcat->subcat_name_en }}|{{ $subcat->subcat_name_bn }}</option>
													@endforeach
												@endforeach
											</select>

											@error('subcat_id')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>
										
									</div>

									<div class="row mb-3">
										<div class="form-group col-md-6">
											<label for="caste_id" class="text-dark form-label">Fruit Caste <strong class="text-danger">*</strong></label>
											<select class="form-control" id="caste_id" name="caste_id">
												<option disabled selected>Select One</option>
												@foreach($castes as $caste)
												<option value="{{ $caste->id }}">{{ $caste->caste_name_en }}|{{ $caste->caste_name_bn }}</option>
												@endforeach
											</select>

											@error('caste_id')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>

										<div class="form-group col-md-6">
											<label for="garden_id" class="text-dark form-label">Garden <strong class="text-danger">*</strong></label>
											<select class="form-control" id="garden_id" name="garden_id">
												<option disabled selected>Select One</option>
												@foreach($gardens as $garden)
												<option value="{{ $garden->id }}">{{ $garden->garden_name_en }}|{{ $garden->garden_name_bn }}</option>
												@endforeach
											</select>

											@error('garden_id')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>
									</div>

									<div class="row mb-3">
										<div class="form-group col-md-6">
											<label for="regular_price" class="text-dark form-label">Regular Price <strong class="text-danger">*</strong></label>
											<input type="text" class="form-control" id="regular_price" name="regular_price">

											@error('regular_price')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>

										<div class="form-group col-md-6">
											<label for="discount_price" class="text-dark form-label">Discount Price</label>
											<input type="text" class="form-control" id="discount_price" name="discount_price">

											@error('discount_price')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>
									</div>

									<div class="row mb-3">
										<div class="form-group col-md-6">
											<label for="unit" class="text-dark form-label">Unit <strong class="text-danger">*</strong></label>
											<input type="text" value="{{ old('unit') }}" class="form-control" id="unit" name="unit">

											@error('unit')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>

										<div class="form-group col-md-6">
											<label for="stock_qty" class="text-dark form-label">Stock Quantity <strong class="text-danger">*</strong></label>
											<input type="number" value="{{ old('stock_qty') }}" class="form-control" id="stock_qty" name="stock_qty">

											@error('stock_qty')
											    <strong class="text-danger">
											        <strong>{{ $message }}</strong>
											    </strong>
											@enderror
										</div>
									</div>

									<div class="form-group mb-3">
										<label for="p_description_en" class="text-dark form-label">English Description <strong class="text-danger">*</strong></label>
										<textarea name="p_description_en" id="p_description_en" class="form-control des_en"></textarea>

										@error('p_description_en')
										    <strong class="text-danger">
										        <strong>{{ $message }}</strong>
										    </strong>
										@enderror
									</div>

									<div class="form-group mb-3">
										<label for="p_description_bn" class="text-dark form-label">Bangla Description <strong class="text-danger">*</strong></label>
										<textarea name="p_description_bn" id="p_description_bn" class="form-control des_bn"></textarea>

										@error('p_description_bn')
										    <strong class="text-danger">
										        <strong>{{ $message }}</strong>
										    </strong>
										@enderror
									</div>

									<div class="form-group mb-3">
										<label for="yt_video_code" class="text-dark form-label">Youtube video embed code</label>
										<input type="text" name="yt_video_code" id="yt_video_code" class="form-control" placeholder="YouTube video embeded code ..." />
									</div>
								</div>

								<div class="card-footer">
									<a href="{{ route('admin.product.index') }}" class="btn btn-danger">Cancel</a>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
		                	</div>

		                	<div class="col-md-4">
		                		<div class="form-group mb-3">
									<label for="thumbnail" class="text-dark form-label">Thumbnail <strong class="text-danger">*</strong></label>
									<input type="file" name="thumbnail" id="thumbnail" class="form-control" />

									@error('thumbnail')
									    <strong class="text-danger">
									        <strong>{{ $message }}</strong>
									    </strong>
									@enderror
								</div>

								<div class=" mb-3">  
				                    <table class="table table-bordered" id="dynamic_field">
					                    <div class="card-header">
					                      <h6 class="card-title text-dark">More Images (Click Add For More Image)</h6>
					                    </div> 
										<tr>  
										  <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>  
										  <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>  
										</tr>  
				                    </table>    
				                </div>

				                <div class="row mb-3">
				                	<div class="col-md-4">
					                	<div class="card form-group p-2">
											<label class="form-label text-dark" for="slider">Slider</label><br>
						                	<div class="form-check form-switch">
											  <input class="form-check-input" value="1" type="checkbox" role="switch" name="slider" id="slider">
											</div>
										</div>
									</div>
				                	<div class="col-md-4">
					                	<div class="card form-group p-2">
											<label class="form-label text-dark" for="hot_deal">Hot Deal</label><br>
						                	<div class="form-check form-switch">
											  <input class="form-check-input" value="1" type="checkbox" role="switch" name="hot_deal" id="hot_deal">
											</div>
										</div>
									</div>
				                	<div class="col-md-4">
					                	<div class="card form-group p-2">
											<label class="form-label text-dark" for="today_deal">Today Deal</label><br>
						                	<div class="form-check form-switch">
											  <input class="form-check-input" value="1" type="checkbox" role="switch" name="today_deal" id="today_deal">
											</div>
										</div>
									</div>
				                </div>

				                <div class="row">
				                	<div class="col-md-4">
					                	<div class="card form-group p-2">
											<label class="form-label text-dark" for="trendy">Trendy</label><br>
						                	<div class="form-check form-switch">
											  <input class="form-check-input" value="1" type="checkbox" role="switch" name="trendy" id="trendy">
											</div>
										</div>
									</div>
				                	<div class="col-md-4">
					                	<div class="card form-group p-2">
											<label class="form-label text-dark" for="featured">Featured</label><br>
						                	<div class="form-check form-switch">
											  <input class="form-check-input" value="1" type="checkbox" role="switch" name="featured" id="featured">
											</div>
										</div>
									</div>
				                	<div class="col-md-4">
					                	<div class="card form-group p-2">
											<label class="form-label text-dark" for="status">Status</label><br>
						                	<div class="form-check form-switch">
											  <input class="form-check-input" value="1" type="checkbox" role="switch" name="status" id="status">
											</div>
										</div>
									</div>
				                </div>
		                	</div>
		                </div>
					</form>
	            </div>
	        </div>
	    </div>
	</div>

@endsection

@push('script')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
	tinymce.init({
		selector: '.des_en'
	});
	tinymce.init({
		selector: '.des_bn'
	});

	// add more image load on ajax
	$(document).ready(function(){      
       var postURL = "<?php echo url('addmore'); ?>";
       var i=1;  


       $('#add').click(function(){  
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
       });  

       $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
       });  
     }); 
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$('#thumbnail').dropify();
	});
</script>
@endpush