<?php

namespace App\Modules\Admin\User\Models;

use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Models\Traits\UserRoles;
use App\Modules\Admin\User\Models\Scopes\DeleteUserScope;
use Illuminate\Database\Eloquent\Builder;
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
        'firstname',
        'email',
        'password',
        'lastname',
        'phone',
        'status',
        'token'
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

    protected $dates = [
        'sms_expired'
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

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeUserByPhone(Builder $builder, $phone): Builder
    {
        $phone = str_replace(")+",") ",$phone);
        return $builder->where('phone', $phone);
    }

    public function getUser($email, $phone)
    {

        if ($email) {
            return $this->where('email', $email)->first();
        } else if ($phone) {
            return $this->where('phone', $phone)->first();
        } else if ($email && $phone) {
            return $this->where('email', $email)->orWhere('phone', $phone)->first();
        }

        return null;

    }

    public function getUserBySms($code)
    {

        if ($code) {
            return $this
                ->whereDate('sms_expired', '<=' ,Carbon::now()->format('Y-m-d H:i:s'))
                ->where('sms_code', $code)
                ->first();
        }

        return null;

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
