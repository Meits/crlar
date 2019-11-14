<?php

namespace App\Modules\Admin\Lead\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    public function leads()
    {
        return $this->belongsToMany(Lead::class);
    }
}
