<?php

namespace App\Modules\Admin\Email\Models;


use App\Modules\Common\Localization\Traits\Localization;

class Email extends Localization
{
    //
    protected $fillable = [

    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function content()
    {
        return $this->hasOne(EmailContent::class);
    }
}
