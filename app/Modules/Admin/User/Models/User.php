<?php

namespace App\Modules\Admin\User\Models;

use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Models\Traits\UserRoles;
use App\Modules\Admin\User\Models\Scopes\DeleteUserScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, UserRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DeleteUserScope());
    }

    /**
     * @return mixed
     */
    public function scopeIsActive() {
        return $this->active;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email) {
        return $this->where('email',$email)->first();
    }

}
