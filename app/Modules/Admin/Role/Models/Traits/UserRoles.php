<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 13.10.2019
 * Time: 20:06
 */

namespace App\Modules\Admin\Role\Models\Traits;


use App\Modules\Admin\Role\Models\Role;
use Illuminate\Support\Str;

trait UserRoles
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() {
        return $this->belongsToMany(Role::class,'role_user');
    }

    /**
     * @param $permission
     * @param bool $require
     * @return bool
     */
    public function canDo($permission, $require = FALSE) {
        if(is_array($permission)) {
            foreach($permission as $permName) {
                $permName = $this->canDo($permName);
                if($permName && !$require) {
                    return TRUE;
                }
                else if(!$permName  && $require) {
                    return FALSE;
                }
            }

            return  $require;
        }
        else {
            foreach($this->roles as $role) {
                foreach($role->perms as $perm) {
                    if(Str::is($permission,$perm->alias)) {
                        return TRUE;
                    }
                }
            }
        }
    }

    /**
     * @param $name
     * @param bool $require
     * @return bool
     */
    public function hasRole($name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);

                if ($hasRole && !$require) {
                    return true;
                } elseif (!$hasRole && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->roles as $role) {
                if ($role->alias == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getUsersBySearch($request)
    {

        $result = $this->select("*");

        if ($request->search) {

            $result->where(function ($query) use ($request) {
                $query->where('firstname', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('lastname', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%');
            });

        }

        if ($request->role_id) {
            $result->whereHas('roles', function ($query) use ($request) {
                $query->where('roles.id', $request->role_id);
            });
        }

        if ($request->is_moderate !== "" && $request->is_moderate !== null) {
            $result->where('is_moderate', $request->is_moderate);
        }

        if($request->status !== "" && $request->status!== null) {
            $result->where('status',$request->status);
        }

        return $result;
    }


    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->status = 1;
        $this->token = null;
        if ($this->save()) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}