<?php

namespace App\Http\Controllers\Admin;

use App\Models\Garden;
use App\Models\Subcat;
use App\Models\Product;
use App\Models\Category;
use App\Models\Fruitcaste;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keywords = $request->keyword;
        $per_page = $request->per_page ?: 10;

        $products = Product::with('category', 'subcat', 'garden', 'caste')->latest('id');

        if ($keywords) {
            $keywords = '%' . $keywords . '%';
            $products = $products->where('garden_name_en', 'like', $keywords)
                ->orWhere('garden_name_bn', 'like', $keywords)
                ->orWhere('garden_location_en', 'like', $keywords)
                ->orWhere('garden_location_bn', 'like', $keywords)
                ->paginate($per_page);
            return view('admin.product.index', compact('products'));
        }
        $products = $products->paginate($per_page);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest('id')->get();
        $castes     = Fruitcaste::latest('id')->get();
        $gardens    = Garden::latest('id')->get();
        return view('admin.product.create', compact('categories', 'castes', 'gardens'));
    }

    // bangla slug make
    function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validate = Validator::make($request->all(), [
                'p_name_bn' => 'required',
                'p_name_en' => 'required',
                'p_code' => 'required',
                'subcat_id' => 'required',
                'garden_id' => 'required',
                'caste_id' => 'required',
                'regular_price' => 'required|numeric',
                'discount_price' => 'nullable|numeric',
                'p_description_en' => 'required',
                'p_description_bn' => 'required',
                'unit' => 'required',
                'stock_qty' => 'required|numeric',
                'thumbnail' => 'required|image',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $subcat = Subcat::where('id', $request->subcat_id)->first();

            $product = new Product;
            $product->cat_id             = $subcat->cat_id;
            $product->subcat_id          = $subcat->id;
            $product->caste_id           = $request->caste_id;
            $product->garden_id          = $request->garden_id;
            $product->admin_id           = \Auth::user()->id;
            $product->p_name_en          = $request->p_name_en;
            $product->p_slug_en          = Str::slug($request->p_name_en, '-');
            $product->p_name_bn          = $request->p_name_bn;
            $product->p_slug_bn          = $this->make_slug($request->p_name_bn);
            $product->p_code             = $request->p_code;
            $product->p_description_en   = $request->p_description_en;
            $product->p_description_bn   = $request->p_description_bn;
            $product->regular_price      = $request->regular_price;
            $product->discount_price     = $request->discount_price;
            $product->unit               = $request->unit;
            $product->stock_qty          = $request->stock_qty;
            $product->yt_video_code      = $request->yt_video_code;
            $product->slider             = $request->slider ?: 0;
            $product->featured           = $request->featured ?: 0;
            $product->hot_deal           = $request->hot_deal ?: 0;
            $product->today_deal         = $request->today_deal ?: 0;
            $product->trendy             = $request->trendy ?: 0;
            $product->status             = $request->status ?: 0;

            $thumbnail = $request->file('thumbnail');
            $slug = Str::slug($request->p_name_en, '-');
            if($thumbnail){
                $extension = $thumbnail->getClientOriginalExtension();
                $fileNameToStore = $slug.'_'.time().'.'.$extension; // Filename to store
                $thumbnail->storeAs('public/products/thumbnail',$fileNameToStore); // Upload Image

                $product->thumbnail = 'products/thumbnail/'.$fileNameToStore;
            }

            //multiple images
            $images = array();
            if($request->hasFile('images')){
               foreach ($request->file('images') as $key => $image) {
                   $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                   $image->storeAs('public/products/images',$imageName); 
                   array_push($images, $imageName);
               }
               $product->images = json_encode($images);
            }

            $product->save();
            toast('Product store successfully', 'success');
            DB::commit();
            return redirect()->route('admin.product.index');

        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * active product status.
     */
    public function activeSlider(Product $product)
    {
        DB::beginTransaction();
        try {

            $product->update([
                'slider' => 1,
            ]);
            toast('Slider Activated successfully', 'success');

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * inactive product status.
     */
    public function inactiveSlider(Product $product)
    {
        DB::beginTransaction();
        try {

            $product->update([
                'slider' => 0,
            ]);
            toast('Slider InActivated successfully', 'success');

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * active product status.
     */
    public function activeStatus(Product $product)
    {
        DB::beginTransaction();
        try {

            $product->update([
                'status' => 1,
            ]);
            toast('Caste Activated successfully', 'success');

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * inactive product status.
     */
    public function inactiveStatus(Product $product)
    {
        DB::beginTransaction();
        try {

            $product->update([
                'status' => 0,
            ]);
            toast('Caste InActivated successfully', 'success');

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::latest('id')->get();
        $castes     = Fruitcaste::latest('id')->get();
        $gardens    = Garden::latest('id')->get();
        return view('admin.product.edit', compact('product', 'categories', 'castes', 'gardens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        DB::beginTransaction();
        try {
            $validate = Validator::make($request->all(), [
                'p_name_bn' => 'required',
                'p_name_en' => 'required',
                'p_code' => 'required',
                'subcat_id' => 'required',
                'garden_id' => 'required',
                'caste_id' => 'required',
                'regular_price' => 'required|numeric',
                'discount_price' => 'nullable|numeric',
                'p_description_en' => 'required',
                'p_description_bn' => 'required',
                'unit' => 'required',
                'stock_qty' => 'required|numeric',
                'thumbnail' => 'nullable|image',
                '*.images' => 'nullable|image',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $subcat = Subcat::where('id', $request->subcat_id)->first();

            $product->cat_id             = $subcat->cat_id;
            $product->subcat_id          = $subcat->id;
            $product->caste_id           = $request->caste_id;
            $product->garden_id          = $request->garden_id;
            $product->admin_id           = \Auth::user()->id;
            $product->p_name_en          = $request->p_name_en;
            $product->p_slug_en          = Str::slug($request->p_name_en, '-');
            $product->p_name_bn          = $request->p_name_bn;
            $product->p_slug_bn          = $this->make_slug($request->p_name_bn);
            $product->p_code             = $request->p_code;
            $product->p_description_en   = $request->p_description_en;
            $product->p_description_bn   = $request->p_description_bn;
            $product->regular_price      = $request->regular_price;
            $product->discount_price     = $request->discount_price;
            $product->unit               = $request->unit;
            $product->stock_qty          = $request->stock_qty;
            $product->yt_video_code      = $request->yt_video_code;
            $product->slider             = $request->slider ?: 0;
            $product->featured           = $request->featured ?: 0;
            $product->hot_deal           = $request->hot_deal ?: 0;
            $product->today_deal         = $request->today_deal ?: 0;
            $product->trendy             = $request->trendy ?: 0;
            $product->status             = $request->status ?: 0;

            $thumbnail = $request->file('thumbnail');
            $slug = Str::slug($request->p_name_en, '-');
            if($thumbnail){
                if ($request->old_thumbnail) {
                    Storage::disk('public')->delete($request->old_thumbnail);
                }
                $extension = $thumbnail->getClientOriginalExtension();
                $fileNameToStore = $slug.'_'.time().'.'.$extension; // Filename to store
                $thumbnail->storeAs('public/products/thumbnail',$fileNameToStore); // Upload Image

                $product->thumbnail = 'products/thumbnail/'.$fileNameToStore;
            }

            //multiple images update
            $old_images = $request->has('old_images');
            if($old_images){
                $images = $request->old_images;
                $product->images = json_encode($images);
            }else{
                $images = array();
                $product->images = json_encode($images); 
            }

            if($request->hasFile('images')){
                foreach ($request->file('images') as $key => $image) {
                   $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                   $image->storeAs('public/products/images',$imageName); 
                   array_push($images, $imageName);
               }
               $product->images = json_encode($images);
            }
            $product->save();
            toast('Product updated successfully', 'success');
            DB::commit();
            return redirect()->route('admin.product.index');

        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            if ($product->images) {
                $images = json_decode($product->images, true);
                foreach ($images as $image) {
                    Storage::disk('public')->delete('products/images/'.$image);
                }
            }
            $product->delete();
            toast('Product deleted successfully', 'success');

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
