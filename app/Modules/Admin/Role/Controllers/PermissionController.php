<?php

namespace App\Modules\Admin\Role\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Permission;
use App\Modules\Admin\Role\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Collection $roles */
        $roles = Role::all();

        /** @var Collection $permissions */
        $permissions = Permission::all();

        /** @var String $title */
        $this->title = __("admin.pages_permissions_title");

        /** @var String $content */
        $this->content = view('Admin::Permission.index')->with(['roles' => $roles, 'priv' => $permissions, 'title' => $this->title])->render();

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
        $this->authorize('create', Role::class);

        $data = $request->except('_token');

        $roles = Role::all();

        foreach($roles as $value) {
            if(isset($data[$value->id])) {
                $value->savePermissions($data[$value->id]);
            }

            else {
                $value->savePermissions([]);
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

}
