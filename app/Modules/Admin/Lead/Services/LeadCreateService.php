<?php
/**
 * Created by PhpStorm.
 * User: Develooper
 * Date: 25.07.2019
 * Time: 16:33
 */

namespace App\Modules\Lead\Services;


use App\Modules\Lead\Models\Lead;
use App\Modules\Lead\Models\Status;

/**
 * Class LeadCreateService
 * @package App\Services
 */
class LeadCreateService
{
    /**
     * Save lead comment
     */
    public static function saveLead(Lead $lead, Status $status)
    {
        /** @var Lead $lead */
        $leadAdd = new Lead();
        //save
        $leadAdd->link = $lead->link;
        $leadAdd->phone = $lead->phone;
        $leadAdd->unit_id = $lead->unit_id;
        $leadAdd->user_id = '29';
        $leadAdd->source_id = $lead->source_id;
        $leadAdd->count_create = 0;
        $leadAdd->is_robot = '1';
        $leadAdd->is_add_sale = '1';
        $leadAdd
            ->status()
            ->associate($status)
            ->save();
        return $leadAdd;
    }
}
