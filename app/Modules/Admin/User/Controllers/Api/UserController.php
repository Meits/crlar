<?php

namespace App\Modules\Admin\User\Controllers\Api;

use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        $users->transform(function ($item) {
            $item->rolename = "";
            if (isset($item->roles)) {
                $item->rolename = isset($item->roles->first()->title) ? $item->roles->first()->title : "";
            }

            return $item;
        });

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
        //check access
        //$this->authorize('edit', new User());

        /** @var User $user */
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(32),
            'active' => '1',
            'status' => '1',
        ]);

        /**@var Role $role */
        $role = Role::findOrFail($request->role_id);
        if ($role) {
            $user->roles()->attach($role->id);
        }

        //add role name to user object
        $user->rolename = $role->name;

        //send response
        return response()->json([
            'user' => $user->toArray(),
        ]);
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
        $user->active = '0';
        $user->update();

        return response()->json($user->toArray());
    }
}
