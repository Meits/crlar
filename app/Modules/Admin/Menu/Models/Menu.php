<?php

namespace App\Modules\Admin\Menu\Models;

use App\Modules\Admin\Role\Models\Permission;
use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Menu extends Model
{

    const MENU_TYPE_FRONT = 'front';
    const MENU_TYPE_ADMIN = 'admin';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perms() {
        return $this->belongsToMany(Permission::class,'permission_menu');
    }

    public function scopeFrontMenu($query, User $user) {

        //dd($user->permissions);

        return $query->
                where('type',self::MENU_TYPE_FRONT)->
                whereHas('perms', function($query) use ($user) {
                    $arr = collect($user->getMergedPermissions())->map(function($item) {
                        return $item['id'];
                    });
                    $query->whereIn('id', $arr->toArray());
                })
                ;
    }
}
