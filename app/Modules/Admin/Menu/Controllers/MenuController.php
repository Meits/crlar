<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 18.11.2019
 * Time: 21:13
 */

namespace App\Modules\Admin\Menu\Controllers;


use App\Modules\Admin\Menu\Models\Menu;
use Illuminate\Support\Facades\Auth;

class MenuController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::frontMenu(Auth::user())->get();
        return response()->json($menu->toArray());
    }
}