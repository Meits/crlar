<?php

namespace App\Modules\Admin\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table="datas";

    protected $fillable = [
        'page_id',
        'field_id',
        'alias',
        'value',
        'title',
    ];

    public function field()
    {
        return $this->belongsTo('App\Models\Field');
    }
}
