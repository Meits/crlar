<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 14.11.2019
 * Time: 22:44
 */

namespace App\Modules\Admin\Lead\Models\Traits;


use App\Modules\Lead\Models\Lead;
use App\Modules\LeadComment\Models\LeadComment;

trait UserLeadsTrait
{
    public function leads() {
        return $this->hasMany(Lead::class);
    }
    public function tasks() {
        return $this->hasMany('App\Models\Task');
    }
    public function responsibleTasks() {
        return $this->hasMany('App\Models\Task','responsible_id','id');
    }
    public function comments() {
        return $this->hasMany(LeadComment::class);
    }
}