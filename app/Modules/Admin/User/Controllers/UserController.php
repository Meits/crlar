<?php

namespace App\Modules\Admin\User\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\User\Models\Filters\UserSearch;
use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Requests\UserRequest;
use App\Modules\Admin\User\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Base
{

    /**
     * Statuses const list
     */
    const STATUSES = [
        1 => 'Active',
        2 => 'InActive',
        3 => 'Deleted',
        4 => 'Archive',
        0 => 'InActive',
    ];

    /**
     *  Moderate const list
     */
    const MODERATE = [
        1 => 'Moderate',
        0 => 'Not Moderate'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserSearch $userSearch)
    {
        $search = $request->input('search');
        $roleId = $request->input('role_id');
        $isModerate = $request->input('is_moderate');
        $isStatus = $request->input('status',null);

        //$users = $user->getUsersBySearch($request)->paginate(config('settings.paginate_admin'))->appends(request()->input());

        $users = $userSearch->apply($request)->paginate(config('settings.paginate_admin'))->appends(request()->input());
        /** @var String $title */
        $this->title = __("admin.users_page_title");

        /** @var String $content */
        $this->content = view('Admin::User.index')
            ->with([
                'statuses' => self::STATUSES,
                'moderate' => self::MODERATE,
                'users' => $users, 'roles' => Role::all(),
                'title' => $this->title,
                'search' => $search,
                'roleId' => $roleId,
                'isStatus' => $isStatus,
                'isModerate' => $isModerate
            ])->render();

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
        $this->title = __("admin.user_create_title");
        $isStatus = null;
        /** @var Role $roles */
        $roles = Role::all();

        /** @var String $content */
        $this->content = view('Admin::User.create')
            ->with([
                'isStatus' => $isStatus,
                'statuses' => self::STATUSES,
                'title' => $this->title,
                'roles' => $roles
            ])->render();

        //render output
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserService $userService)
    {

        if($userService->create($request)) {
            /** @return Redirect */
            return \Redirect::route('users.index')
                ->with(
                    [
                        'message' => \trans('admin.users_create_success_message'),
                        'status' => 'success',
                    ]
                );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        /** @var String $title */
        $this->title = __("admin.user_edit_title");;
        $isStatus = $user->status;
        $roles = Role::all();

        /** @var String $content */
        $this->content = view('Admin::User.edit')
            ->with([
                'isStatus' => $isStatus,
                'statuses' => self::STATUSES,
                'title' => $this->title,
                'roles' => $roles,
                'user' => $user
            ])->render();

        //render output
        return $this->renderOutput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\User\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\User\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user, UserService $userService)
    {

        if($userService->update($request, $user)) {
            /** @return Redirect */
            return \Redirect::route('users.index')
                ->with(
                    [
                        'message' => \trans('admin.users_update_success_message'),
                        'status' => 'success',
                    ]
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\User\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->status = 3;
        $user->save();

        /** @return Redirect */
        return \Redirect::route('users.index')
            ->with(
                [
                    'message' => \trans('admin.users_delte_success_message'),
                    'status' => 'success',
                ]
            );
    }
}
