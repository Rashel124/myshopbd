<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\Policy;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function showSettings()
    {
       $settings = Setting::first();
      return view('backend.settings.showsettings', compact('settings'));
    }

       public function updateSettings (Request $request)
    {
        $settings = Setting::first();

        $settings->phone = $request->phone;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->instragram = $request->instragram;
        $settings->youtube = $request->youtube;
        $settings->free_shipping_amount = $request->free_shipping_amount;
        
        if(isset($request->logo)){

            if($settings->logo && file_exists('backend/images/settings/'.$settings->logo)){
                unlink('backend/images/settings/'.$settings->logo);
            }

            $imageName = rand().'-logo-'.'.'.$request->logo->extension(); //12345-logo-.webp
            $request->logo->move('backend/images/settings/', $imageName);

            $settings->logo = $imageName;
        }

        if(isset($request->hero_image)){

            if($settings->hero_image && file_exists('backend/images/settings/'.$settings->hero_image)){
                unlink('backend/images/settings/'.$settings->hero_image);
            }

            $sliderName = rand().'-slider-'.'.'.$request->hero_image->extension(); //12345-banner-.webp
            $request->hero_image->move('backend/images/settings/', $sliderName);

            $settings->hero_image = $sliderName;
        }
        $settings->save();
        toastr()->success('Settings updated succeesfully!');
        return redirect()->back();
    }

    public function showPolicies()
    {
        $policiesAboutus = Policy::First();
       return view('backend.settings.show-policies', compact('policiesAboutus'));
    }

    public function updatePolicies(Request $request)
    {
        $policiesAboutus = Policy::First();

        $policiesAboutus->about_us = $request->about_us;
        $policiesAboutus->privacy_policy = $request->privacy_policy;
        $policiesAboutus->terms_conditions = $request->terms_conditions;
        $policiesAboutus->refund_policy = $request->refund_policy;
        $policiesAboutus->payment_policy = $request->payment_policy;
        $policiesAboutus->return_policy = $request->return_policy;

        $policiesAboutus->save();
        toastr()->success('Policies updated succeesfully!');
        return redirect()->back();
    }

    public function showBanner()
    {
        $banners = Banner::get();
        return view('backend.settings.show-banners', compact('banners'));
    }

    public function editBanner($id)
    {
        $banner = Banner::find($id);
        return view('backend.settings.edit-banner', compact('banner'));
    }

    public function updateBanner(Request $request, $id)
    {
        $banner = Banner::find($id);

         if(isset($request->image)){

            if($banner->image && file_exists('backend/images/banner/'.$banner->image)){
                unlink('backend/images/banner/'.$banner->image);
            }

            $imageName = rand().'-banner-'.'.'.$request->image->extension(); //12345-banner-.webp
            $request->image->move('backend/images/banner/', $imageName);

            $banner->image = $imageName;
        }

        $banner->save();
        toastr()->success('Banner updated succeesfully!');
        return redirect('/admin/show-banner');
    }

    // Contact Message...
    public function contactMessage()
    {
        $messages = ContactUs::paginate(20);
        return view('backend.settings.contact-message', compact('messages'));
    }
    public function deleteContactMessage($id)
    {
        $message = ContactUs::find($id);
        $message->delete();
        toastr()->success('Message Delete Successfully!');
        return redirect()->back();
    }

    public function showCredentials()
    {
        $user = User::select('name', 'email')->first();
        return view( 'backend.settings.show-credentials', compact('user'));
    }

    public function updateCredentials(Request $request)
    {
        $user = User::first();

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        toastr()->success('Credentials Updated Successfuly!');
        return redirect()->back();
    }
}
