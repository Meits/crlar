<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 05-Jul-19
 * Time: 10:10
 */

namespace App\Modules\Admin\Analitics\Services;


use App\Services\Date\DateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnaliticsDataService
{

    /**
     * @param Request $request
     * @return array
     */
    public function getCountLeadsData(Request $request)
    {
        //set date
        $dateStart = Carbon::now();
        if (isset($request->dateStart) && DateService::isValid($request->dateStart, "d.m.Y")) {
            $dateStart = Carbon::createFromFormat("d.m.Y", $request->dateStart);
        }

        $dateEnd = Carbon::now();
        if (isset($request->dateEnd) && DateService::isValid($request->dateEnd, "d.m.Y")) {
            $dateEnd = Carbon::createFromFormat("d.m.Y", $request->dateEnd);
        }

        /** @var Collection $users */
        $leadsData = DB::select(
            'CALL countLeads("' . $dateStart->format('Y-m-d') . '","' . $dateEnd->format('Y-m-d') . '")'
        );

        return $leadsData;
    }

}