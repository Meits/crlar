<?php

namespace App\Modules\Admin\Faq\Models;

use App\Modules\Common\Localization\Traits\Localization;
use Illuminate\Database\Eloquent\Model;

class Faq extends Localization
{
    protected $fillable = [
        'title',
        'text',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function content()
    {
        return $this->hasOne(FaqContent::class);
    }
}
