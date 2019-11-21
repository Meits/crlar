<?php

namespace App\Modules\Admin\User\Controllers\Api;

use App\Modules\Admin\User\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check access
        $this->authorize('view', new User());

        /** @var Collection $users */
        $users = User::with('roles')->get();
        $users->transform(function ($item) {
            $item->rolename = "";
            if (isset($item->roles)) {
                $item->rolename = isset($item->roles->first()->name) ? $item->roles->first()->name : "";
            }

            return $item;
        });

        //send response
        return response()->json([
            'users' => $users->toArray(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usersGate()
    {
        //check access
        $this->authorize('view', new User());

        /** @var Collection $users */
        $users = User::with('roles')->where('active', '1')->get();

        //send response
        return response()->json([
            'users' => $users->toArray(),
        ]);
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
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\User\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
