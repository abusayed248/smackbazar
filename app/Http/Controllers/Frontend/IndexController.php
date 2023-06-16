<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Fruitcaste;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliderProducts    = Product::where(['status' => 1, 'slider' => 1])->get();
        $todayDealProducts = Product::where(['status' => 1, 'today_deal' => 1])->get();
        $hotDealProducts   = Product::where(['status' => 1, 'hot_deal' => 1])->get();
        $castes            = Fruitcaste::where('status', '=', 1)->get();
        return view('frontend.index', compact('sliderProducts', 'todayDealProducts', 'hotDealProducts', 'castes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function productDetails($id, $slug)
    {
        $singleProduct   = Product::where('p_slug_en', $slug)->first();
        $pd_views = Product::find($id);
        $pd_views->increment('p_views');
        $relatedProducts = Product::where(['status' => 1, 'subcat_id' => $singleProduct->subcat_id])->get();
        return view('frontend.product_details', compact('singleProduct', 'relatedProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
