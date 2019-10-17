<?php

namespace App\Modules\Admin\Email\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Email\Models\Email;
use App\Modules\Admin\Email\Requests\EmailsRequest;
use App\Modules\Admin\Language\Models\Language;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Collection $emails */
        $emails = Email::all();

        /** @var String $title */
        $this->title = __("admin.emails_title");

        /** @var String $content */
        $this->content = view('Admin::Email.index')->with(['emails' => $emails, 'title' => $this->title])->render();

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
     * @param  \App\Modules\Admin\Email\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        /** @var String $title */
        $this->title = __('admin.emails_edit_title', ['title' => __('admin.emails_edit_title')]);

        $languages = Language::all();
        /** @var String $content */
        $this->content = view('Admin::Email.edit')->with([
            'email' => $email,
            'title' => $this->title,
            'languages' => $languages
        ])->render();

        //render output
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmailsRequest $request
     * @param  \App\Modules\Admin\Email\Models\Email $email
     * @return \Illuminate\Http\Response
     */
    public function update(EmailsRequest $request, Email $email)
    {
        $this->authorize('update', $email);


        if($email->fill($request->except('_token'))->save()) {

            $localization = collect($request->localization);
            foreach($localization as $k => $i) {
                /** @var PageLocalization $locale */
                $locale = $email->localizations()
                    ->updateOrCreate(['language_id' => $k], $i);
            }

            return \back()
                ->with(
                    [
                        'message' => \trans('admin.emails_update_success_message'),
                        'status' => 'success',
                    ]
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Email\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
