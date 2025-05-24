<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SiteSetting $sitesetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSetting $siteSetting)
    {
        return view('admin.settings.edit', compact('siteSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSetting $siteSetting)
    {
        $validator = Validator::make($request->all(), [
            'site_title' => 'required',
        ]);

        if($validator->passes()){

            $siteSetting->site_title      = $request->site_title;
            $siteSetting->cta_title       = $request->cta_title;
            $siteSetting->cta_description = $request->cta_description;
            $siteSetting->phone_number    = $request->phone_number;
            $siteSetting->email           = $request->email;
            $siteSetting->address         = $request->address;
            $siteSetting->about_us_description = $request->about_us_description;
            $siteSetting->facebook_url    = $request->facebook_url;
            $siteSetting->twitter_url     = $request->twitter_url;
            $siteSetting->instagram_url   = $request->instagram_url;
            $siteSetting->behance_url     = $request->behance_url;
            $siteSetting->linkedin_url    = $request->linkedin_url;
            $siteSetting->dribble_url     = $request->dribble_url;
            $siteSetting->footer_text     = $request->footer_text;

            $siteSetting->save();

            $request->session()->flash('success', 'Settings updated Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Settings updated Successfully'
            ]);

        } else {
            
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSetting $sitesetting)
    {
        //
    }
}