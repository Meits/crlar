<?php

namespace App\Modules\Lead\Models;

use App\Modules\Admin\Lead\Models\Status;
use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Unit\Models\Unit;
use App\Modules\Admin\User\Models\User;
use App\Modules\LeadComment\Models\LeadComment;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class Lead extends Model
{
    //
    protected $fillable = [
        'link',
        'phone',
        'source_id',
        'unit_id',
        'is_processed',
        'is_express_delivery',
        'is_add_sale',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function statuses()
    {
        return $this->belongsToMany(Status::class);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArchives()
    {
        return $this
            ->with(
                [
                    'statuses',
                    'source',
                    'unit'
                ]
            )
            ->where('updated_at', '<', \DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)'))
            ->where('status_id', 3)
            ->orderBy('updated_at','DESC')
            ->paginate(config('settings.pagination'))
            ;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getLeads()
    {
        return $this
            ->with(
                [
                    'source',
                    'unit',
                    'status'
                ]
            )
            ->whereBetween('status_id', [1,2])
            ->orWhere([

                    ['status_id', 3],
                    ['updated_at', '>', \DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)')],

                ])
            ->orderBy('created_at')
            ->get()
            ;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        return $this->belongsTo(Source::class);
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
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(LeadComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lastComment()
    {
        return $this->comments()->where('comment_value', '!=', NULL)->orderBy('id','desc')->first();
    }

    public function getLeadsLastMonth()
    {
        return $this->with(['source','unit','status'])
            ->where(\DB::raw('DATE_FORMAT(created_at,"%Y-%m-%d")'), '=', \DB::raw('DATE_SUB(CURRENT_DATE, INTERVAL 90 DAY)'))
            ->orderBy('created_at')
            ->get();
    }

}
