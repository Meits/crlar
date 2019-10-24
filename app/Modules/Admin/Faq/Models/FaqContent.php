<?php

namespace App\Modules\Admin\Faq\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FaqContent
 * @package App\Models
 */
class FaqContent extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
        'language_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
