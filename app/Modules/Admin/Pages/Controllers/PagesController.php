<?php

namespace App\Modules\Admin\Pages\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Language\Models\Language;
use App\Modules\Admin\Pages\Models\Page;
use App\Modules\Admin\Pages\Requests\PageRequest;
use App\Services\ImageService;
use App\Services\Url\UrlService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Collection $pages */
        $pages = Page::all();

        /** @var String $title */
        $this->title = __("admin.pages_page_title");

        /** @var String $content */
        $this->content = view('Admin::Pages.index')->with(['pages' => $pages, 'title' => $this->title])->render();

        //render output
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Page::class);

        /** @var String $title */
        $this->title = trans("admin.pages_create_title");

        /** @var String $content */
        $this->content = view('Admin::Pages.create')->with(['title' => $this->title])->render();

        //render output
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $this->authorize('create', Page::class);

        /** @var Role $role */
        $page = new Page();
        //store model
        $page->fill($request->except('_token','alias'));
        $page->alias = $request->alias;

        if(!$request->alias) {
            $urlService = new UrlService(new Page());
            $page->alias = $urlService->getAlias($request->title);
        }
        $page->related_entity = $page->alias;
        $page->save();

        /** @return Redirect */
        return \Redirect::route('pages.index')
            ->with(
                [
                    'message' => \trans('admin.pages_create_success_message'),
                    'status' => 'success',
                ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {

        /** @var String $title */
        $this->title = __('admin.pages_edit_title', ['title' => $page->title]);

        /*$page->datas->transform(function($item) {
            $item->load('field');
        });*/

        $languages = Language::all();
        $page->load('localizations');


        /** @var String $content */
        $this->content = view('Admin::Pages.edit')->with([

            'page' => $page,
            'title' => $this->title,
            'languages' => $languages,

        ])->render();

        //render output
        return $this->renderOutput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Pages\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Pages\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        //update page
        $page->fill($request->except('fields', '_token'));
        $page->update();

        //check page fields
        if ($request->fields) {

            //update fields
            foreach ($request->fields as $key => $field) {

                /** @var Data $model */
                $model = $page->datas->where('alias', $key)->first();
                if($model) {
                    if($model->field->alias != 'file') {
                        $model->value = $field;
                    } else if ($model->alias == 'audio_file') {
                        $model->value = ImageService::handleUploadedAudio(
                            $field,
                            public_path().'/storage/audio/'
                        );
                    }
                    else {
                        if(is_object($field)) {

                            /** @var ineger $width */
                            $width = 0;
                            /** @var ineger $height */
                            $height = 0;

                            //add width and height for image
                            if($model->additional) {
                                list($width, $height) = explode(',',$model->additional);
                            }
                            //save image and get path
                            $model->value = ImageService::handleUploadedImage(
                                $field,
                                $width,
                                $height,
                                public_path().'/storage/images/pages/'
                            );
                        }
                    }
                    //update data model
                    $model->update();
                }
            }
        }
        // redirect back to page
        return \back()
            ->with(
                [
                    'message' => \trans('admin.pages_update_success_message'),
                    'status' => 'success',
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Pages\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
