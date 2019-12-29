<?php

namespace App\Modules\Admin\Analitics\Controllers\Api;

use App\Modules\Admin\Analitics\Services\AnaliticsDataService;
use App\Modules\Admin\User\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnaliticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AnaliticsDataService $analiticsDataService
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AnaliticsDataService $analiticsDataService)
    {
        //check access
        $this->authorize('view', User::class);

        /** @var Array $leadsData */
        $leadsData = $analiticsDataService->getCountLeadsData($request);

        //send response
        return response()->json([
            'leadsData' => $leadsData
        ]);
    }
}
