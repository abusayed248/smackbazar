<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcat;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubcatController extends Controller
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

        $subcats = Subcat::leftJoin('categories', 'categories.id', 'subcats.cat_id')
                    ->select('categories.cat_name_en', 'categories.cat_name_bn', 'subcats.*')->latest('id');

        if ($keywords) {
            $keywords = '%' . $keywords . '%';
            $subcats = $subcats->where('subcat_name_en', 'like', $keywords)
                ->orWhere('subcat_name_bn', 'like', $keywords)
                ->orWhere('subcat_slug_en', 'like', $keywords)
                ->orWhere('subcat_slug_bn', 'like', $keywords)
                ->paginate($per_page);
            return view('admin.subcat.index', compact('subcats'));
        }
        $subcats = $subcats->paginate($per_page);
        return view('admin.subcat.index', compact('subcats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest('id')->get();
        return view('admin.subcat.create', compact('categories'));
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
                'cat_id' => 'required',
                'subcat_name_en' => 'required|max:55',
                'subcat_name_bn' => 'required|max:55',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            Subcat::create([
                'cat_id' => $request->cat_id,
                'subcat_name_en' => $request->subcat_name_en,
                'subcat_name_bn' => $request->subcat_name_bn,
                'subcat_slug_en' => Str::slug($request->subcat_name_en, '-'),
                'subcat_slug_bn' => $this->make_slug($request->subcat_name_bn),
                'status' => $request->status ?: 0,
            ]);
            toast('Subcat Store successfully', 'success');

            DB::commit();
            return redirect()->route('admin.subcat.index');
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * active subcat status.
     */
    public function activeStatus(Subcat $subcat)
    {
        DB::beginTransaction();
        try {

            $subcat->update([
                'status' => 1,
            ]);
            toast('Subcat Activated successfully', 'success');

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * inactive subcat status.
     */
    public function inactiveStatus(Subcat $subcat)
    {
        DB::beginTransaction();
        try {

            $subcat->update([
                'status' => 0,
            ]);
            toast('Subcat InActivated successfully', 'success');

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
    public function edit(Subcat $subcat)
    {
        $categories = Category::latest('id')->get();
        return view('admin.subcat.edit', compact('subcat','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcat $subcat)
    {
        DB::beginTransaction();
        try {
            $validate = Validator::make($request->all(), [
                'cat_id' => 'required',
                'subcat_name_en' => 'required|max:55',
                'subcat_name_bn' => 'required|max:55',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $subcat->update([
                'cat_id' => $request->cat_id,
                'subcat_name_en' => $request->subcat_name_en,
                'subcat_name_bn' => $request->subcat_name_bn,
                'subcat_slug_en' => Str::slug($request->subcat_name_en, '-'),
                'subcat_slug_bn' => $this->make_slug($request->subcat_name_bn),
                'status' => $request->status?: 0,
            ]);
            toast('Subcat updated successfully', 'success');

            DB::commit();
            return redirect()->route('admin.subcat.index');
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcat $subcat)
    {
        DB::beginTransaction();
        try {
            $subcat->delete();
            toast('Subcat Deleted successfully', 'success');

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
