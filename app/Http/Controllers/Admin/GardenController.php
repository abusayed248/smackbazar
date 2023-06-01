<?php

namespace App\Http\Controllers\Admin;

use App\Models\Garden;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GardenController extends Controller
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

        $gardens = Garden::latest('id');

        if ($keywords) {
            $keywords = '%' . $keywords . '%';
            $gardens = $gardens->where('garden_name_en', 'like', $keywords)
                ->orWhere('garden_name_bn', 'like', $keywords)
                ->orWhere('garden_location_en', 'like', $keywords)
                ->orWhere('garden_location_bn', 'like', $keywords)
                ->paginate($per_page);
            return view('admin.garden.index', compact('gardens'));
        }
        $gardens = $gardens->paginate($per_page);
        return view('admin.garden.index', compact('gardens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.garden.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validate = Validator::make($request->all(), [
                'garden_name_en' => 'required|unique:gardens|max:155',
                'garden_name_bn' => 'required|unique:gardens|max:155',
                'garden_location_en' => 'required|unique:gardens|max:155',
                'garden_location_bn' => 'required|unique:gardens|max:155',
                'garden_image' => 'nullable|image',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $garden = Garden::create([
                'garden_name_en' => $request->garden_name_en,
                'garden_name_bn' => $request->garden_name_bn,
                'garden_location_en' => $request->garden_location_en,
                'garden_location_bn' => $request->garden_location_bn,
                'status'        => $request->status ?: 0,
            ]);

            $image = $request->file('garden_image');
            $slug = Str::slug($request->garden_name_en, '-');
            if($image){
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $slug.'_'.time().'.'.$extension; // Filename to store
                $image->storeAs('public/gardens',$fileNameToStore); // Upload Image

                $garden->garden_image = 'gardens/'.$fileNameToStore;
                $garden->save(); 
            }

            $garden->save();
            toast('Garden data store successfully', 'success');
            DB::commit();
            return redirect()->route('admin.garden.index');
            
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * active subcat status.
     */
    public function activeStatus(Garden $garden)
    {
        DB::beginTransaction();
        try {

            $garden->update([
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
    public function inactiveStatus(Garden $garden)
    {
        DB::beginTransaction();
        try {

            $garden->update([
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
    public function edit(Garden $garden)
    {
        return view('admin.caste.edit', compact('garden'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Garden $garden)
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

            $garden->update([
                'caste_name_en' => $request->caste_name_en,
                'caste_name_bn' => $request->caste_name_bn,
                'caste_slug_en' => Str::slug($request->caste_name_en, '-'),
                'status'        => $request->status ?: 0,
            ]);

            $image = $request->file('garden_image');
            $slug = Str::slug($request->caste_name_en, '-');
            if($image){
                if ($request->old_garden_image) {
                    Storage::disk('public')->delete($request->old_garden_image);
                }

                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $slug.'_'.time().'.'.$extension; // Filename to store
                $image->storeAs('public/gardens',$fileNameToStore); // Upload Image

                $garden->garden_image = 'gardens/'.$fileNameToStore;
                $garden->save(); 
            }

            $garden->save();
            toast('Garden data updated successfully', 'success');
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
    public function destroy(Garden $garden)
    {
        DB::beginTransaction();
        try {
            if ($garden->garden_image) {
                Storage::disk('public')->delete($garden->garden_image);
            }
            $garden->delete();
            toast('Garden data deleted successfully', 'success');

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
