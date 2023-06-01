<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fruitcaste;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FruitcasteController extends Controller
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

        $castes = Fruitcaste::latest('id');

        if ($keywords) {
            $keywords = '%' . $keywords . '%';
            $castes = $castes->where('caste_name_en', 'like', $keywords)
                ->orWhere('caste_name_bn', 'like', $keywords)
                ->orWhere('caste_slug_en', 'like', $keywords)
                ->orWhere('caste_slug_bn', 'like', $keywords)
                ->paginate($per_page);
            return view('admin.caste.index', compact('castes'));
        }
        $castes = $castes->paginate($per_page);
        return view('admin.caste.index', compact('castes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.caste.create');
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
                'caste_name_en' => 'required|unique:fruitcastes|max:55',
                'caste_name_bn' => 'required|unique:fruitcastes|max:55',
                'caste_image' => 'required|image',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $caste = Fruitcaste::create([
                'caste_name_en' => $request->caste_name_en,
                'caste_name_bn' => $request->caste_name_bn,
                'caste_slug_en' => Str::slug($request->caste_name_en, '-'),
                'caste_slug_bn' => $this->make_slug($request->caste_name_bn),
                'status'        => $request->status ?: 0,
            ]);

            $image = $request->file('caste_image');
            $slug = Str::slug($request->caste_name_en, '-');
            if($image){
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $slug.'_'.time().'.'.$extension; // Filename to store
                $image->storeAs('public/castes',$fileNameToStore); // Upload Image

                $caste->caste_image = 'castes/'.$fileNameToStore;
                $caste->save(); 
            }
            $caste->save();
            toast('Caste Store successfully', 'success');

            DB::commit();
            return redirect()->route('admin.caste.index');
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * active subcat status.
     */
    public function activeStatus(Fruitcaste $fruitcaste)
    {
        DB::beginTransaction();
        try {

            $fruitcaste->update([
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
     * inactive subcat status.
     */
    public function inactiveStatus(Fruitcaste $fruitcaste)
    {
        DB::beginTransaction();
        try {

            $fruitcaste->update([
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
    public function edit(Fruitcaste $caste)
    {
        return view('admin.caste.edit', compact('caste'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fruitcaste $caste)
    {
        DB::beginTransaction();
        try {
            $validate = Validator::make($request->all(), [
                'caste_name_en' => 'required|max:55',
                'caste_name_bn' => 'required|max:55',
                'caste_image' => 'nullable|image',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $caste->update([
                'caste_name_en' => $request->caste_name_en,
                'caste_name_bn' => $request->caste_name_bn,
                'caste_slug_en' => Str::slug($request->caste_name_en, '-'),
                'caste_slug_bn' => $this->make_slug($request->caste_name_bn),
                'status'        => $request->status ?: 0,
            ]);

            $image = $request->file('caste_image');
            $slug = Str::slug($request->caste_name_en, '-');
            if($image){
                if ($request->old_caste_image) {
                    Storage::disk('public')->delete($request->old_caste_image);
                }

                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $slug.'_'.time().'.'.$extension; // Filename to store
                $image->storeAs('public/castes',$fileNameToStore); // Upload Image

                $caste->caste_image = 'castes/'.$fileNameToStore;
                $caste->save(); 
            }

            $caste->save();
            toast('Caste updated successfully', 'success');
            DB::commit();
            return redirect()->route('admin.caste.index');
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fruitcaste $fruitcaste)
    {
        DB::beginTransaction();
        try {
            if ($fruitcaste->caste_image) {
                Storage::disk('public')->delete($fruitcaste->caste_image);
            }
            $fruitcaste->delete();
            toast('Caste Deleted successfully', 'success');

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
