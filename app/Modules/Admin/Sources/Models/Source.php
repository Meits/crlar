<?php

namespace App\Modules\Admin\Sources\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];
}
