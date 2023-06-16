@extends('layouts.app')

@section('content')

@php
    function bn_date($str) {
         $en = array(1,2,3,4,5,6,7,8,9,0);
        $bn = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $str = str_replace($en, $bn, $str);
        $en = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
        $en_short = array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' );
        $bn = array( 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর' );
        $str = str_replace( $en, $bn, $str );
        $str = str_replace( $en_short, $bn, $str );
        $en = array('Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
         $en_short = array('Sat','Sun','Mon','Tue','Wed','Thu','Fri');
         $bn_short = array('শনি', 'রবি','সোম','মঙ্গল','বুধ','বৃহঃ','শুক্র');
         $bn = array('শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার');
         $str = str_replace( $en, $bn, $str );
         $str = str_replace( $en_short, $bn_short, $str );
         $en = array( 'am', 'pm' );
        $bn = array( 'পূর্বাহ্ন', 'অপরাহ্ন' );
        $str = str_replace( $en, $bn, $str );
         $str = str_replace( $en_short, $bn_short, $str );
         $en = array( '১২', '২৪' );
        $bn = array( '৬', '১২' );
        $str = str_replace( $en, $bn, $str );
         return $str;
    }
@endphp



<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="{{ url('/') }}">@if(session()->get('lang') == 'eng') Home @else হোম @endif</a></li>
				<li><a href="#">@if(session()->get('lang') == 'eng') {{ $singleProduct->category->cat_name_en }} @else {{ $singleProduct->category->cat_name_bn }} @endif</a></li>
				<li><a href="#">@if(session()->get('lang') == 'eng') {{ $singleProduct->subcat->subcat_name_en }} @else {{ $singleProduct->subcat->subcat_name_bn }} @endif</a></li>
				<li class="active">@if(session()->get('lang') == 'eng') {{ $singleProduct->p_name_en }} @else {{ $singleProduct->p_name_bn }} @endif</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view">
							<div class="product-view">
								<img src="{{ asset('storage/'. $singleProduct->thumbnail) }}" alt="">
							</div>
						</div>
						<div id="product-view">
							@php
							$images = json_decode($singleProduct->images, true);
							@endphp
							@foreach($images as $image)
							<div class="product-view">
								<img src="{{ asset('storage/products/images/'.$image) }}" alt="">
							</div>
							@endforeach
						</div>
					</div>
					<div class="col-md-6">
						<div class="product-body">
							@if($singleProduct->discount_price)
                            @php
                                $price = ($singleProduct->regular_price-$singleProduct->discount_price)*100;
                                $percentage = $price/$singleProduct->regular_price;
                            @endphp
                            <div class="product-label">
                                <span class="sale">@if(session()->get('lang') == 'eng'){{ number_format($percentage, 0, '.') }}@else {{ bn_date(number_format($percentage, 0, '.')) }} @endif% </span>
                            </div>
                            @endif
							<h2 class="product-name">@if(session()->get('lang') == 'eng') {{ $singleProduct->p_name_en }}@else {{ $singleProduct->p_name_bn }}@endif</h2>

							@if($singleProduct->discount_price) 
                            <h3 class="product-price">৳@if(session()->get('lang') == 'eng') {{ $singleProduct->discount_price }} @else {{ bn_date($singleProduct->discount_price) }} @endif<del class="product-old-price">৳@if(session()->get('lang') == 'eng') {{ $singleProduct->regular_price }} @else {{ bn_date($singleProduct->regular_price) }} @endif</del></h3>
                            @else
                            <h3 class="product-price">৳@if(session()->get('lang') == 'eng') {{ $singleProduct->regular_price }}@else {{ bn_date($singleProduct->regular_price) }} @endif</h3>
                            @endif

							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
								<span >@if(session()->get('lang') == 'eng') 3 Review(s) @else ৩ রিভিউ(স) @endif</span>
							</div>
							<p><strong>@if(session()->get('lang') == 'eng') Availability @else উপস্থিতি @endif:</strong> @if($singleProduct->stock_qty >= 1)@if(session()->get('lang') == 'eng') In Stock @else স্টক এ আছে @endif @else <span class="text-danger">@if(session()->get('lang') == 'eng')Out of stock @else স্টক শেষ @endif</span> @endif</p>
							<p>
								@if(session()->get('lang') == 'eng')
								<strong>Varaities:</strong> {{ $singleProduct->caste->caste_name_en }}
								@else 
								<strong>জাত:</strong> {{ $singleProduct->caste->caste_name_bn }}
								@endif
							</p>
							<p>
								@if(session()->get('lang') == 'eng')
								<strong>Garden:</strong> {{ $singleProduct->garden->garden_name_en }}
								@else 
								<strong>বাগান:</strong> {{ $singleProduct->garden->garden_name_bn }}
								@endif
							</p>
							<div class="product-btns">
								<div class="qty-input">
									<span class="text-uppercase">QTY: </span>
									<input class="input" type="number" min="1">
								</div>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> @if(session()->get('lang') == 'eng') Add to Cart @else কার্টে যোগ করুন @endif</button>
							</div>
							<div class="product-btns" style="margin-top: 15px">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active">
									<a data-toggle="tab" href="#tab1">
										@if(session()->get('lang') == 'eng')
										Description
										@else
										বর্ণনা
										@endif
									</a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab2">
										@if(session()->get('lang') == 'eng')
										Reviews (3)
										@else
										পর্যালোচনা (3)
										@endif
									</a>
								</li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<p>
										@if(session()->get('lang') == 'eng')
										{!! $singleProduct->p_description_en !!}
										@else
										{!! $singleProduct->p_description_bn !!}
										@endif
									</p>
								</div>
								<div id="tab2" class="tab-pane fade in">

									<div class="row">
										<div class="col-md-6">
											<div class="product-reviews">
												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>

												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>

												<ul class="reviews-pages">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="col-md-6">
											<h4 class="text-uppercase">Write Your Review</h4>
											<p>Your email address will not be published.</p>
											<form class="review-form">
												<div class="form-group">
													<input class="input" type="text" placeholder="Your Name" />
												</div>
												<div class="form-group">
													<input class="input" type="email" placeholder="Email Address" />
												</div>
												<div class="form-group">
													<textarea class="input" placeholder="Your review"></textarea>
												</div>
												<div class="form-group">
													<div class="input-rating">
														<strong class="text-uppercase">Your Rating: </strong>
														<div class="stars">
															<input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
															<input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
															<input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
															<input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
															<input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
														</div>
													</div>
												</div>
												<button class="primary-btn">Submit</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">@if(session()->get('lang') == 'eng')Similar Products @else অনুরূপ পণ্য @endif</h2>
					</div>
				</div>
				<!-- section title -->

				<!-- Product Single -->
				@foreach($relatedProducts as $relatedProduct)
				<div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            @if($relatedProduct->discount_price)
                            @php
                                $price = ($relatedProduct->regular_price-$relatedProduct->discount_price)*100;
                                $percentage = $price/$relatedProduct->regular_price;
                            @endphp
                            <div class="product-label">
                                <span class="sale">@if(session()->get('lang') == 'eng'){{ number_format($percentage, 0, '.') }}@else {{ bn_date(number_format($percentage, 0, '.')) }} @endif% </span>
                            </div>
                            @endif

                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('storage/'.$relatedProduct->thumbnail) }}" alt="">
                        </div>
                        <div class="product-body">

                            @if($relatedProduct->discount_price) 
                            <h3 class="product-price">৳@if(session()->get('lang') == 'eng') {{ $relatedProduct->discount_price }} @else {{ bn_date($relatedProduct->discount_price) }} @endif<del class="product-old-price">৳@if(session()->get('lang') == 'eng') {{ $relatedProduct->regular_price }} @else {{ bn_date($relatedProduct->regular_price) }} @endif</del></h3>
                            @else
                            <h3 class="product-price">৳@if(session()->get('lang') == 'eng') {{ $relatedProduct->regular_price }}@else {{ bn_date($relatedProduct->regular_price) }} @endif</h3>
                            @endif

                            @if($relatedProduct->stock_qty >= 1)
                            <div class="product-rating">
								@if(session()->get('lang') == 'eng') {{ $relatedProduct->stock_qty }} In stock @else {{ bn_date($relatedProduct->stock_qty) }} স্টক এ আছে @endif
							</div>
							@endif

                            <h2 class="product-name"><a href="{{ route('product.details',['id' => $relatedProduct->id, 'slug' => $relatedProduct->p_slug_en]) }}">@if(session()->get('lang') == 'eng') {{ $relatedProduct->p_name_en }}@else {{ $relatedProduct->p_name_bn }}@endif</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i>@if(session()->get('lang') == 'eng')  Add to Cart @else কার্টে যোগ করুন @endif</button>
                            </div>
                        </div>
                    </div>
				</div>
                @endforeach
				<!-- /Product Single -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->


@endsection