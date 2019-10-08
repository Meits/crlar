<?php

namespace App\Modules\Admin\Dashboard\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var String $title */
        $this->title = __("admin.pages_home_title");
        /** @var String $content */
        $this->content = view('Admin::Dashboard.index')->with(['title' => $this->title])->render();

        //render output
        return $this->renderOutput();
    }

}
