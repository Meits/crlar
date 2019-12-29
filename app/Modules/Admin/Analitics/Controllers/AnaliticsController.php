<?php

namespace App\Modules\Admin\Analitics\Controllers;

use App\Modules\Admin\Analitics\Exports\LeadsExport;
use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\User\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Excel;

class AnaliticsController extends Base
{

    public function export(User $user, $dateStart, $dateEnd, Excel $excel) {
        $export = new LeadsExport($user,$dateStart, $dateEnd);
        return $excel->download($export, 'leads.xlsx');
    }


}
