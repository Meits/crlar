<?php

namespace App\Modules\Lead\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    public function leads()
    {
        return $this->belongsToMany(Lead::class);
    }
}
