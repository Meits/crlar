<?php

namespace App\Modules\Admin\Pages\Models;

use App\Modules\Common\Localization\Traits\Localization;
use Illuminate\Database\Eloquent\Model;

class Page extends Localization
{

    protected $fillable = [
        'alias',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function datas()
    {
        return $this->hasMany('App\Models\Data');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function content()
    {
        return $this->hasOne('App\Models\PageContent');
    }

    public function multifields($alias)
    {
        return $this->hasMany('App\Models\Data')->where('field_id', '=', '9')->where('alias','like', $alias) ;
    }

}
