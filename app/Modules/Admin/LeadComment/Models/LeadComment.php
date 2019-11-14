<?php

namespace App\Modules\LeadComment\Models;

use App\Modules\Admin\Lead\Models\Status;
use App\Modules\Admin\User\Models\User;
use App\Modules\Lead\Models\Lead;
use Illuminate\Database\Eloquent\Model;

class LeadComment extends Model
{
    //
    protected $fillable = [
        'text',
        'comment_value',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
