<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 12.09.2019
 * Time: 21:40
 */

namespace App\Modules\Admin\Dashboard\Classes;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Menu;
use App\Modules\Admin\Menu\Models\Menu as MenuModel;


class Base extends Controller
{

    /**
     *
     * @var String $title
     */
    protected $vars = array();

    /**
     *
     * @var String $title
     */
    protected $title = FALSE;

    /**
     *
     * @var String $description
     */
    protected $description = FALSE;

    /**
     *
     * @var String $template
     */
    protected $template = FALSE;


    /**
     *
     * @var String $locale
     */
    protected $locale;

    /**
     *
     * @var String $user
     */
    protected $user;

    /**
     *
     * @var String $content
     */
    protected $content;

    /**
     *
     * @var String $sideBar
     */
    protected $sideBar;

    /**
     * Base constructor.
     */
    public function __construct() {

        $this->template = 'Admin::Dashboard.dashboard';

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     *@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    protected function renderOutput() : View {

        //render view
        $menu = $this->getMenu();
        $photo = null;//Setting::where('field','system_photo')->first()->value;

        if(!$this->sideBar) {
            $this->sidebar = view('Admin::layouts.parts.sidebar')->with(['menu'=>$menu, 'photo' => $photo, 'user' => Auth::user()])->render();
        }

        $this->vars = Arr::add($this->vars, 'sidebar', $this->sidebar);
        $this->vars = Arr::add($this->vars, 'content', $this->content);

        return view($this->template)->with($this->vars);
    }

    private function getMenu()
    {
        return Menu::make('menuRendrer', function($m)  {

            foreach(MenuModel::where('type','admin')->get() as $item) {

                $path = $item->path;
                if($item->path && $this->checkRoute($item->path)) {
                    $path = route($item->path);
                }

                if($item->parent == 0) {
                    $m->add($item->title,$path)->id($item->id)->data('permissions', $this->getPermissions($item));
                }

                else {
                    if($m->find($item->parent)) {
                        $m->find($item->parent)->add($item->title,$path)->id($item->id)->data('permissions', $this->getPermissions($item));
                    }
                }
            }

        })->filter(function ($item) {

            if ($this->user && $this->user->canDo($item->data('permissions'))) {
                return true;
            }
            return false;
        });
    }

    /**
     * @param $route
     * @return bool
     */
    function checkRoute($route)
    {

        if($route[0] === "/"){
            $route = substr($route, 1);
        }
        $routes = \Route::getRoutes()->getRoutes();

        foreach ($routes as $r) {
            /** @var \Route $r */
            if ($r->getName() == $route) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param MenuModel $item
     * @return Array
     */
    private function getPermissions(\App\Modules\Admin\Menu\Models\Menu $item) : Array
    {
        return $item->perms->map(function($item) {
            return $item->alias;
        })->toArray();
    }
}