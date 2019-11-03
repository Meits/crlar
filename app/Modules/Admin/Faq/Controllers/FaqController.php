<?php

namespace App\Modules\Admin\Faq\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Faq\Models\Faq;
use App\Modules\Admin\Language\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Faq $faq */
        $faq = Faq::with('localization')->orderBy('created_at', 'DESC')->paginate(config('settings.paginate_admin'));

        /** @var String $title */
        $this->title = __("admin.faq_page_title");

        /** @var String $content */
        $this->content = view('Admin::Faq.index')->with(['faqs' => $faq, 'title' => $this->title])->render();

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
        /** @var String $title */
        $this->title = "Create Faq";

        $languages = Language::all();

        /** @var String $content */
        $this->content = view('Admin::Faq.create')->with(['title' => $this->title, 'languages' => $languages])->render();

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
        $faq = new Faq();
        //store model
        $faq->fill($request->except('_token','localization'))->save();

        $localization = collect($request->localization);

        foreach($localization as $k => $i) {
            /** @var PageLocalization $locale */
            $faq->localizations()
                ->create($i + ['language_id' => $k]);
        }

        return\Redirect::route('faqs.index')
            ->with(
                [
                    'message' => \trans('admin.pages_update_success_message'),
                    'status' => 'success',
                ]
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Faq\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        //
        ///** @var String $title */
        $this->title = $faq->title;

        $languages = Language::all();

        /** @var String $content */
        $this->content = view('Admin::Faq.edit')->with(['faq' => $faq, 'title' => $this->title, 'languages' => $languages])->render();

        //render output
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Faq\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        //update model
        $faq->fill($request->except('_token','localization'))->update();

        $localization = collect($request->localization);
        foreach($localization as $k => $i) {
            /** @var PageLocalization $locale */
            $locale = $faq->localizations()
                ->updateOrCreate(['language_id' => $k], $i);
        }

        return\back()->with(
            [
                'message' => \trans('admin.pages_update_success_message'),
                'status' => 'success',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Faq\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        // redirect back to page
        return \back()
            ->with(
                [
                    'message' => \trans('admin.program_delete_success_message'),
                    'status' => 'success',
                ]
            );
    }
}
