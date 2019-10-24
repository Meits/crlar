<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 24-Oct-19
 * Time: 09:51
 */

namespace App\Modules\Admin\User\Services;


use App\Modules\Admin\User\Events\ModerateConfirm;
use App\Modules\Admin\User\Models\User;
use Illuminate\Http\Request;

class UserService
{

    /**
     * @param Request $request
     * @return bool
     */
    public function create(Request $request) {
        /** @var User $user */
        $user = new User();
        //store model
        $user->fill($request->except('_token','role_id','password'));
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $user->roles()->attach($request->input('role_id'));

        return true;
    }

    /**
     * @param Reuqest $request
     * @param User $user
     * @return bool
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->except('_token', 'password', 'role_id'));
        if($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        if($user->save()) {
            $user->roles()->sync($request->input('role_id'));
            return true;
        }

        return false;
    }
}