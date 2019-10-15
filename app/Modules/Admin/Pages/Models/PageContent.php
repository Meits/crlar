<?php

namespace App\Modules\Admin\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{

    protected $fillable  = [

        'title',
        'titleH1',
        'description',
        'text',
        'language_id',
        'page_id',

    ];

    //
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
