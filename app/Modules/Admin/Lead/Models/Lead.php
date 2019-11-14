<?php

namespace App\Modules\Lead\Models;

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
        return $this->belongsToMany('App\Models\Status');
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
        return $this->belongsTo('App\Models\Status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        return $this->belongsTo('App\Models\Source');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\LeadComment');
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
