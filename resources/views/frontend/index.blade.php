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

<!-- HOME -->
    <div id="home">
        <!-- container -->
        <div class="container">
            <!-- home wrap -->
            <div class="home-wrap">
                <!-- home slick -->
                <div id="home-slick">
                    <!-- banner -->
                    @foreach($sliderProducts as $sliderProduct)
                    @php
                        if($sliderProduct->discount_price) {
                            $price = ($sliderProduct->regular_price-$sliderProduct->discount_price)*100;
                            $percentage = $price/$sliderProduct->regular_price;
                        } 
                    @endphp
                    <div class="banner banner-1">
                        <img class="slider-img" src="{{ asset('storage/'.$sliderProduct->thumbnail) }}" alt="" />
                        <div class="banner-caption text-center">
                            <h1>@if(session()->get('lang') == 'eng') {{ $sliderProduct->p_name_en }} @else {{ $sliderProduct->p_name_bn }} @endif</h1>
                            @if(session()->get('lang') == 'eng')
                            <h3 class="white-color font-weak">Up to {{ number_format($percentage, 2, '.') }}% Discount</h3>
                            @else 
                            <h3 class="white-color font-weak">{{ bn_date(number_format($percentage, 2, '.')) }}% পর্যন্ত ছাড়</h3>
                            @endif
                            <button class="primary-btn">@if(session()->get('lang') == 'eng') Shop Now @else এখনই কিনুন @endif</button>
                        </div>
                    </div>
                    @endforeach
                    <!-- /banner -->
                </div>
                <!-- /home slick -->
            </div>
            <!-- /home wrap -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOME -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section-title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="title">@if(session()->get('lang') == 'eng')Deals Of The Day @else আজকের ডিল @endif</h2>
                        <div class="pull-right">
                            <div class="product-slick-dots-1 custom-dots"></div>
                        </div>
                    </div>
                </div>
                <!-- /section-title -->

                <!-- banner -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="banner banner-2">
                        <img src="{{ asset('frontend') }}/img/banner14.jpg" alt="">
                        <div class="banner-caption">
                            <h2 class="white-color">@if(session()->get('lang') == 'eng') NEW<br>COLLECTION @else নতুন কালেকশন @endif</h2>
                            <button class="primary-btn">@if(session()->get('lang') == 'eng') Shop Now @else এখনই কিনুন @endif</button>
                        </div>
                    </div>
                </div>
                <!-- /banner -->

                <!-- Product Slick -->
                <div class="col-md-9 col-sm-6 col-xs-6">
                    <div class="row">
                        <div id="product-slick-1" class="product-slick">
                            <!-- Product Single -->

                            @foreach($todayDealProducts as $todayDealProduct)
                            <div class="product product-single">
                                <div class="product-thumb">
                                    @if($todayDealProduct->discount_price)
                                    @php
                                        $price = ($todayDealProduct->regular_price-$todayDealProduct->discount_price)*100;
                                        $percentage = $price/$todayDealProduct->regular_price;
                                    @endphp
                                    <div class="product-label">
                                        <span class="sale">@if(session()->get('lang') == 'eng'){{ number_format($percentage, 0, '.') }}@else {{ bn_date(number_format($percentage, 0, '.')) }} @endif% </span>
                                    </div>
                                    @endif
        
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('storage/'.$todayDealProduct->thumbnail) }}" alt="">
                                </div>
                                <div class="product-body text-center">

                                    @if($todayDealProduct->discount_price) 
                                    <h3 class="product-price">৳@if(session()->get('lang') == 'eng') {{ $todayDealProduct->discount_price }} @else {{ bn_date($todayDealProduct->discount_price) }} @endif<del class="product-old-price">৳@if(session()->get('lang') == 'eng') {{ $todayDealProduct->regular_price }} @else {{ bn_date($todayDealProduct->regular_price) }} @endif</del></h3>
                                    @else
                                    <h3 class="product-price">৳@if(session()->get('lang') == 'eng') {{ $todayDealProduct->regular_price }}@else {{ bn_date($todayDealProduct->regular_price) }} @endif</h3>
                                    @endif

                                    <h2 class="product-name"><a href="#">@if(session()->get('lang') == 'eng') {{ $todayDealProduct->p_name_en }}@else {{ $todayDealProduct->p_name_bn }}@endif</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- /Product Single -->
                        </div>
                    </div>
                </div>
                <!-- /Product Slick -->
            </div>
            <!-- /row -->

            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="title">@if(session()->get('lang') == 'eng') Hot Deal Of The Day @else আজকের হট ডিল @endif</h2>
                        <div class="pull-right">
                            <div class="product-slick-dots-2 custom-dots">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- section title -->

                <!-- Product Slick -->
                <div class="col-md-9 col-sm-6 col-xs-6">
                    <div class="row">
                        <div id="product-slick-2" class="product-slick">
                            <!-- Product Single -->
                            @foreach($hotDealProducts as $hotDealProduct)
                            <div class="product product-single">
                                <div class="product-thumb">
                                    @if($hotDealProduct->discount_price)
                                    @php
                                        $price = ($hotDealProduct->regular_price-$hotDealProduct->discount_price)*100;
                                        $percentage = $price/$hotDealProduct->regular_price;
                                    @endphp
                                    <div class="product-label">
                                        <span class="sale">@if(session()->get('lang') == 'eng'){{ number_format($percentage, 0, '.') }}@else {{ bn_date(number_format($percentage, 0, '.')) }} @endif% </span>
                                    </div>
                                    @endif
        
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('storage/'.$hotDealProduct->thumbnail) }}" alt="">
                                </div>
                                <div class="product-body text-center">

                                    @if($hotDealProduct->discount_price) 
                                    <h3 class="product-price">৳@if(session()->get('lang') == 'eng') {{ $hotDealProduct->discount_price }} @else {{ bn_date($hotDealProduct->discount_price) }} @endif<del class="product-old-price">৳@if(session()->get('lang') == 'eng') {{ $hotDealProduct->regular_price }} @else {{ bn_date($hotDealProduct->regular_price) }} @endif</del></h3>
                                    @else
                                    <h3 class="product-price">৳@if(session()->get('lang') == 'eng') {{ $hotDealProduct->regular_price }}@else {{ bn_date($hotDealProduct->regular_price) }} @endif</h3>
                                    @endif

                                    <h2 class="product-name"><a href="#">@if(session()->get('lang') == 'eng') {{ $hotDealProduct->p_name_en }}@else {{ $hotDealProduct->p_name_bn }}@endif</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- /Product Single -->

                        </div>
                    </div>
                </div>
                <!-- /Product Slick -->
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
                        <h2 class="title">Latest Products</h2>
                    </div>
                </div>
                <!-- section title -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product01.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50</h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span>New</span>
                                <span class="sale">-20%</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product02.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span>New</span>
                                <span class="sale">-20%</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product03.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span>New</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product04.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50</h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->
            </div>
            <!-- /row -->

            <!-- row -->
            <div class="row">
                <!-- banner -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="banner banner-2">
                        <img src="{{ asset('frontend') }}/img/banner15.jpg" alt="">
                        <div class="banner-caption">
                            <h2 class="white-color">NEW<br>COLLECTION</h2>
                            <button class="primary-btn">Shop Now</button>
                        </div>
                    </div>
                </div>
                <!-- /banner -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span>New</span>
                                <span class="sale">-20%</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product07.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span>New</span>
                                <span class="sale">-20%</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product06.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span>New</span>
                                <span class="sale">-20%</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product05.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->
            </div>
            <!-- /row -->

            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="title">Picked For You</h2>
                    </div>
                </div>
                <!-- section title -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product04.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50</h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span>New</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product03.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50</h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="sale">-20%</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product02.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->

                <!-- Product Single -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span>New</span>
                                <span class="sale">-20%</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('frontend') }}/img/product01.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                            <div class="product-btns">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
    

    <!-- section -->
    <div class="section caste">
        <!-- container -->
        <div class="container">
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-sm-12 text-center">
                    <h2>@if(session()->get('lang') == 'eng')Fruit Varieties @else ফলের জাত @endif</h2><hr>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <!-- banner -->
                <div class="col-md-12">
                    <div id="caste-slick">
                    <!-- banner -->
                        @foreach($castes as $caste)
                        <a href="" class="col-md-2">
                            <img height="80" width="170" src="{{ asset('storage/'.$caste->caste_image) }}" alt="" />
                        </a>
                        @endforeach                        
                    <!-- /banner -->
                    </div>
                </div>
                <!-- /banner -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
@endsection