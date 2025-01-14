<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\PropertyCondition;
use App\Models\ServiceSetting;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $setting = Setting::find(1);
        $setting->fill($request->only([
            'paypal_email', 'paypal_api_key', 'paypal_api_password',
            'stripe_email', 'stripe_api_key', 'stripe_api_password',
            'google_api_key', 'hourly_rate', 'jumbo_bag_rate'
        ]))->save();

        for ($index = 1; $index < 25; $index++) {
            // Find the PropertyCondition record by ID
            $condition = PropertyCondition::find($index);
        
            // Check if the record exists before attempting to update it
            if ($condition) {
                // Update the value from the request
                $condition->value = $request->input('condition' . $index);
                $condition->save();
            }
        }

        for($index = 1; $index < 17; $index++){
            $service = ServiceSetting::find($index);

            // Check if the record exists before attempting to update it
            if ($service) {
                // Update the value from the request
                $service->value = $request->input('service' . $index);
                $service->save();
            }
        }

        return redirect()->back();
    }
}
