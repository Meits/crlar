<?php

namespace App\Modules\Admin\Setting\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Setting\Models\Setting;
use App\Modules\Admin\Setting\Requests\SettingRequest;
use App\Services\ImageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Collection $settings */
        $settings = Setting::all();

        /** @var String $title */
        $this->title = "Settings";

        /** @var String $content */
        $this->content = view('Admin::Setting.index')->with(['settings' => $settings, 'title' => $this->title])->render();

        //render output
        return $this->renderOutput();
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
     * @param  \App\Modules\Admin\Setting\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Setting\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id = null)
    {
        /** @var array $data*/
        $data = $request->except('_token','_method');

        /** @var array $fields*/
        $fields = [];
        if($data) {
            foreach ($data as $k=>$field) {

                /** @var Setting $setting*/
                $setting = Setting::where('field',$k)->firstOrFail();

                $value = $field;
                if($setting->type == 'file') {
                    if($request->hasFile($k)) {
                        $value = ImageService::handleUploadedImage(
                            $request->file($k),
                            config('settings.system_photo.width'),
                            config('settings.system_photo.height'),
                            public_path().'/userfiles/images/'
                        );
                    }
                }
                //setting update
                $setting->fill(
                    [
                        'value'=>$value
                    ]
                )->update();
            }
        }

        // redirect back to page
        return \back()
            ->with(
                [
                    'message' => \trans('admin.settings_update_success_message'),
                    'status' => 'success',
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Setting\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
