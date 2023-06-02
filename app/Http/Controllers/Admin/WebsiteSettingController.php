<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WebsiteSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $websiteSetting = WebsiteSetting::first();
        return view('admin.website_setting.edit', compact('websiteSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebsiteSetting $websiteSetting)
    {
        DB::beginTransaction();
        try {
            $validate = Validator::make($request->all(), [
                'address_en'    => 'required|max:255',
                'address_bn'    => 'required|max:255',
                'phone_en'      => 'required|regex:/(01)[0-9]/|numeric|digits:11',
                'phone_bn'      => 'required|regex:/(01)[0-9]/|numeric|digits:11',
                'email'         => 'required|email',
                'suport_email' => 'required|email',
                'site_logo'     => 'nullable|image',
                'site_favicon'  => 'nullable|image',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $websiteSetting->update([
                'address_en'    => $request->address_en,
                'address_bn'    => $request->address_bn,
                'phone_en'      => $request->phone_en,
                'phone_bn'      => $request->phone_bn,
                'email'         => $request->email,
                'suport_email' => $request->suport_email,
            ]);

            $image = $request->file('site_logo');
            $slug = Str::slug('Smack Bazar Logo', '-');
            if($image){
                if ($request->old_site_logo) {
                    Storage::disk('public')->delete($request->old_site_logo);
                }

                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $slug.'_'.time().'.'.$extension; // Filename to store
                $image->storeAs('public/website_setting',$fileNameToStore); // Upload Image

                $websiteSetting->site_logo = 'website_setting/'.$fileNameToStore;
                $websiteSetting->save(); 
            }

            $favicon = $request->file('site_favicon');
            $faviconSlug = Str::slug('Smack Bazar Favicon', '-');
            if($favicon){
                if ($request->old_site_favicon) {
                    Storage::disk('public')->delete($request->old_site_favicon);
                }

                $extension = $favicon->getClientOriginalExtension();
                $fileNameToStore = $faviconSlug.'_'.time().'.'.$extension; // Filename to store
                $favicon->storeAs('public/website_setting',$fileNameToStore); // Upload Image

                $websiteSetting->site_favicon = 'website_setting/'.$fileNameToStore;
                $websiteSetting->save(); 
            }

            $websiteSetting->save();
            toast('Website Setting updated successfully', 'success');
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
