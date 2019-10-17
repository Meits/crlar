<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 17.10.2019
 * Time: 21:51
 */

namespace App\Modules\Admin\Email\Models;


use Illuminate\Database\Eloquent\Model;

class EmailContent extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'template',
        'language_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}