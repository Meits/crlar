<?php

namespace App\Modules\Admin\Role\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use App\Services\Url\UrlService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Role::class);

        /** @var Collection $roles */
        $roles = Role::all();

        /** @var String $title */
        $this->title = trans("admin.roles_page_title");

        /** @var String $content */
        $this->content = view('Admin::Role.index')->with(['roles' => $roles, 'title' => $this->title])->render();

        /** render output */
        return $this->renderOutput();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        /** @var String $title */
        $this->title = trans("admin.roles_create_title");

        /** @var String $content */
        $this->content = view('Admin::Role.create')->with(['title' => $this->title])->render();

        /** render output */
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
        $this->authorize('create', Role::class);

        /** @var Role $role */
        $role = new Role();

        /** store Role */
        $role->fill($request->except('_token'));
        if(!$request->alias) {
            $urlService = new UrlService(new Role());
            $role->alias = $urlService->getAlias($request->title);
        }
        $role->save();

        /** @return Redirect */
        return \Redirect::route('roles.index')
            ->with(
                [
                    'message' => \trans('admin.roles_create_success_message'),
                    'status' => 'success',
                ]
            );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', Role::class);

        /** @var String $title */
        $this->title = trans("admin.roles_update_title");

        /** @var String $content */
        $this->content = view('Admin::Role.edit')->with(['title' => $this->title,'role' => $role])->render();

        //render output
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', Role::class);

        $role->fill($request->except('_token'));
        if($role->save()) {

            /** @return Redirect */
            return \Redirect::route('roles.index')
                ->with(
                    [
                        'message' => \trans('admin.roles_update_success_message'),
                        'status' => 'success',
                    ]
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', Role::class);

        $role->delete();

        /** @return Redirect */
        return \Redirect::route('roles.index')
            ->with(
                [
                    'message' => \trans('admin.roles_delte_success_message'),
                    'status' => 'success',
                ]
            );
    }
}
