@extends('layouts.admin')

@section('title', 'Edit Website Setting')
    
@section('admin_content')

	<div class="container-fluid px-4">
	   <div class="row justify-content-center mt-5">
	        <div class="col-xl-7 col-md-7">

				<div class="row">
			        <h3 class="mt-4">Website Setting Edit</h3>
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
		            <form method="POST" action="{{ route('admin.website-setting.update', $websiteSetting->id) }}" enctype="multipart/form-data">
		                @csrf

		                <div class="card-body">
						  <div class="row mb-2">
							  <div class="form-group col-lg-6">
							    <label for="address_en" class="text-dark form-label">Address English <strong class="text-danger">*</strong></label>
							    <input type="text" value="{{ $websiteSetting->address_en }}" class="form-control" id="address_en" name="address_en" />

							    @error('address_en')
		                            <strong class="text-danger">
		                                <strong>{{ $message }}</strong>
		                            </strong>
		                        @enderror
							  </div>

							  <div class="form-group col-lg-6">
							    <label for="address_bn" class="text-dark form-label">Address Bangla <strong class="text-danger">*</strong></label>
							    <input type="text" value="{{ $websiteSetting->address_bn }}" class="form-control" id="address_bn" name="address_bn" />

							    @error('address_bn')
		                            <strong class="text-danger">
		                                <strong>{{ $message }}</strong>
		                            </strong>
		                        @enderror
							  </div>
						  </div>

						  <div class="row mb-2">
						  	<div class="form-group col-lg-6">
							    <label for="phone_en" class="text-dark form-label">Phone English <strong class="text-danger">*</strong></label>
							    <input type="text" value="{{ $websiteSetting->phone_en }}" class="form-control" id="phone_en" name="phone_en">

							    @error('phone_en')
		                            <strong class="text-danger">
		                                <strong>{{ $message }}</strong>
		                            </strong>
		                        @enderror
							</div>

							<div class="form-group col-lg-6">
							    <label for="phone_bn" class="text-dark form-label">Phone Bangla <strong class="text-danger">*</strong></label>
							    <input type="text" value="{{ $websiteSetting->phone_bn }}" class="form-control" id="phone_bn" name="phone_bn">

							    @error('phone_bn')
		                            <strong class="text-danger">
		                                <strong>{{ $message }}</strong>
		                            </strong>
		                        @enderror
							</div>
						  </div>

						  <div class="row mb-2">
							  <div class="form-group col-lg-6">
							    <label for="email" class="text-dark form-label">Email <strong class="text-danger">*</strong></label>
							    <input type="email" value="{{ $websiteSetting->email }}" class="form-control" id="email" name="email">

							    @error('email')
		                            <strong class="text-danger">
		                                <strong>{{ $message }}</strong>
		                            </strong>
		                        @enderror
							  </div>

							  <div class="form-group col-lg-6">
							    <label for="suport_email" class="text-dark form-label">Support Email <strong class="text-danger">*</strong></label>
							    <input type="email" value="{{ $websiteSetting->suport_email }}" class="form-control" id="suport_email" name="suport_email">

							    @error('suport_email')
		                            <strong class="text-danger">
		                                <strong>{{ $message }}</strong>
		                            </strong>
		                        @enderror
							  </div>
						  </div>
						  
						  <div class="row mb-2">
							  <div class="form-group col-lg-6">
							  	@isset($websiteSetting->site_logo)
								  <div class="form-group mb-2">
								    <label  class="text-dark form-label">Existing Site Logo</label><br>
								    <img src="{{ asset('storage/'. $websiteSetting->site_logo) }}" height="50" width="50" alt="" />
								  </div>
								@endisset

							    <label for="site_logo" class="text-dark form-label">Website Logo <strong class="text-danger">*</strong></label>
							    <input type="file" data-height="100px" class="form-control site_logo" id="site_logo" name="site_logo">
							    <input type="hidden" name="old_site_logo" value="{{ $websiteSetting->site_logo }}">

							    @error('site_logo')
		                            <strong class="text-danger">
		                                <strong>{{ $message }}</strong>
		                            </strong>
		                        @enderror
							  </div>

							  <div class="form-group col-lg-6">
							  	@isset($websiteSetting->site_favicon)
								  <div class="form-group mb-2">
								    <label  class="text-dark form-label">Existing Site Favicon</label><br>
								    <img src="{{ asset('storage/'. $websiteSetting->site_favicon) }}" height="16" width="16" alt="" />
								  </div>
								@endisset

							    <label for="site_favicon" class="text-dark form-label">Website Favicon <strong class="text-danger">*</strong></label>
							    <input type="file" data-height="100px" class="form-control site_favicon" id="site_favicon" name="site_favicon">
							    <input type="hidden" name="old_site_favicon" value="{{ $websiteSetting->site_favicon }}">

							    @error('site_favicon')
		                            <strong class="text-danger">
		                                <strong>{{ $message }}</strong>
		                            </strong>
		                        @enderror
							  </div>
						  </div>
		                </div>

					  	<div class="card-footer">
					  		<button type="submit" class="btn btn-success">Update</button>
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
		$('.site_logo').dropify();
		$('.site_favicon').dropify();
	});
</script>
@endpush