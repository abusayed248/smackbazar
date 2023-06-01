<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        $per_page = $request->per_page?:10;

        $categories = Category::latest('id');

        if ($keywords) {
            $keywords = '%'.$keywords.'%';
            $categories = $categories->where('cat_name_en', 'like', $keywords)
                        ->orWhere('cat_name_bn', 'like', $keywords)
                        ->orWhere('cat_slug_en', 'like', $keywords)
                        ->orWhere('cat_slug_bn', 'like', $keywords)
                        ->paginate($per_page);
            return view('admin.category.index', compact('categories'));
        }
        $categories = $categories->paginate($per_page);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    // bangla slug make
    function make_slug($string) {
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
                'cat_name_en' => 'required|unique:categories|max:25',
                'cat_name_bn' => 'required|unique:categories|max:25',
            ]);
            if($validate->fails()){
              return back()->withErrors($validate->errors())->withInput();
            }

            Category::create([
                'cat_name_en' => $request->cat_name_en,
                'cat_name_bn' => $request->cat_name_bn,
                'cat_slug_en' => Str::slug($request->cat_name_en, '-'),
                'cat_slug_bn' => $this->make_slug($request->cat_name_bn),
                'status' => $request->status?:0,
            ]);
            toast('Store successfully','success');

            DB::commit();
            return redirect()->route('admin.category.index');
            
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * active category status.
     */
    public function activeStatus(Category $category)
    {
        DB::beginTransaction();
        try {

            $category->update([
                'status' => 1,
            ]);
            toast('Category Activated successfully','success');

            DB::commit();
            return redirect()->back();
            
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * inactive category status.
     */
    public function inactiveStatus(Category $category)
    {
        DB::beginTransaction();
        try {

            $category->update([
                'status' => 0,
            ]);
            toast('Category InActivated successfully','success');

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
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $validate = Validator::make($request->all(), [
                'cat_name_en' => 'required|max:25',
                'cat_name_bn' => 'required|max:25',
            ]);
            if($validate->fails()){
              return back()->withErrors($validate->errors())->withInput();
            }

            $category->update([
                'cat_name_en' => $request->cat_name_en,
                'cat_name_bn' => $request->cat_name_bn,
                'cat_slug_en' => Str::slug($request->cat_name_en, '-'),
                'cat_slug_bn' => $this->make_slug($request->cat_name_bn),
                'status' => $request->status?:0,
            ]);
            toast('Category updated successfully','success');

            DB::commit();
            return redirect()->route('admin.category.index');
            
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->delete();
            toast('Category Deleted successfully','success');

            DB::commit();
            return redirect()->back();
            
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
