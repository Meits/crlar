<?php

namespace App\Modules\Admin\Setting\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'field',
        'value',
        'title',
    ];
}
