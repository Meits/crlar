<?php

namespace App\Modules\Lead\Controllers\Api;

use App\Http\Requests\StoreLead;
use App\Models\Lead;
use App\Models\LeadComment;
use App\Models\Status;
use App\Models\User;
use App\Services\LeadCommentService;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeadsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check access
        $this->authorize('view', Lead::class);
        //DB::enableQueryLog();

        /** @var Collection $leads */
        $leads = new Lead();
        $leads = $leads->getLeads();

        //print_r(DB::getQueryLog());

        /** @var Collection $statuses */
        $statuses = Status::all();

        /** @var Array $resultLeads */
        $resultLeads = [];
        $statuses->each(function ($item, $key) use (&$resultLeads, $leads) {
            $collection = $leads->where('status_id', $item->id);
            $resultLeads[$item->title] = $collection->map(function ($item) {
                return array(
                    'count_create' => $item->count_create,
                    'link' => $item->link,
                    'phone' => $item->phone,
                    'source_title' => $item->source ? $item->source->title : "",
                    'source_id' => $item->source ? $item->source->id : "",
                    'unit_title' => $item->unit ? $item->unit->title : "",
                    'unit_color' => $item->unit ? $item->unit->color : "",
                    'id' => $item->id,
                    'id_source' => $item->source_id,
                    'created_at' => $item->created_at->timestamp,
                    'created_at_o' => $item->created_at->toDateTimeString(),
                    'updated_at' => $item->update_at,
                    'is_processed' => $item->is_processed ? true : false,
                    'is_express_delivery' => $item->is_express_delivery ? true : false,
                    'is_add_sale' => $item->is_add_sale ? true : false,
                    'isQualityLead' => $item->isQualityLead ? true : false,
                    'lastComment' => isset($item->lastComment()->comment_value) ? $item->lastComment()->comment_value : "",
                    'user_id' => $item->user_id,
                    'robot_id' => $this->robot_id(),
                );
            })->toArray();
            $resultLeads[$item->title] = array_values($resultLeads[$item->title]);
        });


        //send response
        return response()->json([
            'leads' => $resultLeads

        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        //check access
        $this->authorize('view', Lead::class);

        /** @var Collection $leads */
        $leads = new Lead();
        $leads = $leads->getArchives();

        //print_r($leads);

        /** @var Array $resultLeads */
        $resultLeads = [];
        $resultLeads = $leads->map(function ($item) {
            return array(
                'count_create' => $item->count_create,
                'link' => $item->link,
                'phone' => $item->phone,
                'source_title' => $item->source->title,
                'source_id' => $item->source->id,
                'unit_title' => $item->unit->title,
                'unit_color' => $item->unit->color,
                'id' => $item->id,
                'id_source' => $item->source_id,
                'created_at' => $item->created_at->timestamp,
                'created_at_o' => $item->created_at->toDateTimeString(),
                'updated_at' => $item->updated_at->toDateTimeString(),
                'is_processed' => $item->is_processed ? true : false,
                'is_express_delivery' => $item->is_express_delivery ? true : false,
                'is_add_sale' => $item->is_add_sale ? true : false,
                'isQualityLead' => $item->isQualityLead ? true : false,
                'lastComment' => isset($item->lastComment()->comment_value) ? $item->lastComment()->comment_value : "",

            );
        })->toArray();
        $resultLeads = array_values($resultLeads);


        //send response
        return response()->json([
            'leads' => $resultLeads

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Check exit lead.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkExist(Request $request)
    {
        //check access
        $this->authorize('save', Lead::class);

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = Lead::select('*');
        if ($request->link && $request->link != "") {
            $queryBuilder->where('link', $request->link);
        } else {
            if ($request->phone && $request->phone != "") {
                $queryBuilder->where('phone', $request->phone);
            }
        }
        $queryBuilder->where('status_id', '!=', 3);
        //проверка на новый лид https://bleecker.worksection.com/project/166491/7846814/7850926/#com19620370 stasSH
        $queryBuilder->where('is_processed', '!=', '1');

        /** @var Lead $lead */
        $lead = $queryBuilder->first();

        if ($lead) {
            return response()->json([
                'exist' => true,
                'lead' => $lead->toArray()
            ]);
        }
        return response()->json([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLead $request)
    {
        //check access
        $this->authorize('save', Lead::class);

        /** @var Lead $lead */
        $lead = new Lead();

        /** @var User $user */
        $user = Auth::user();

        /** @var Status $status */
        $status = Status::where('title', 'new')->firstOrFail();

        //lead save
        $user
            ->leads()
            ->save($lead->fill($request->except('comment'))->status()->associate($status));

        //first comment save
        if (isset($request->text) && $request->text != "") {
            $tmpText = "Пользователь <strong>" . $user->name . ' ' . $user->lastname . '</strong> оставил <strong>комментарий</strong> ' . $request->text;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status, $request->text);
        }

        $is_event = true;/*признак события в лидах*/
        /**Автор лида* создал лид *дата и время создания* со статусом *статус**/
        $tmpText = "Автор <strong>" . $user->name . ' ' . $user->lastname . '</strong> создал лид ' . Carbon::now() . ' <strong> со статусом</strong> ' . $status->title_ru;
        LeadCommentService::saveComment($tmpText, $lead, $user, $status, $request->text, $is_event);


        //lead save status new
        /*if($status) {
            $lead->statuses()->attach($status->id,['created_at' => Carbon::now(),'updated_at' => Carbon::now()]);
        }*/

        //send response
        return response()->json([
            'status' => 'success',
            'lead' => array(
                'count_create' => $lead->count_create ? $lead->count_create : "1",
                'link' => $lead->link,
                'phone' => $lead->phone,
                'source_title' => $lead->source->title,
                'source_id' => $lead->source->id,
                'unit_title' => $lead->unit->title,
                'unit_color' => $lead->unit->color,
                'id' => $lead->id,
                'is_processed' => $lead->is_processed ? true : false,
                'is_express_delivery' => $lead->is_express_delivery ? true : false,
                'is_add_sale' => $lead->is_add_sale ? true : false,
                'isQualityLead' => $lead->isQualityLead ? true : false,
                'created_at' => $lead->created_at->timestamp,
                'created_at_o' => $lead->created_at->toDateTimeString(),
                'lastComment' => isset($lead->lastComment()->comment_value) ? $lead->lastComment()->comment_value : "",

            )
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //check access
        $this->authorize('view', Lead::class);
        //
        return response()->json([
            'lead' => array(
                'count_create' => $lead->count_create,
                'link' => $lead->link,
                'phone' => $lead->phone,
                'source_title' => $lead->source->title,
                'source_id' => $lead->source->id,
                'unit_title' => $lead->unit->title,
                'unit_color' => $lead->unit->color,
                'id' => $lead->id,
                'author' => $lead->user->name,
                'status' => $lead->status->title_ru,
                'status_id' => $lead->status->id,
                'is_processed' => $lead->is_processed ? true : false,
                'is_express_delivery' => $lead->is_express_delivery ? true : false,
                'is_add_sale' => $lead->is_add_sale ? true : false,
                'isQualityLead' => $lead->isQualityLead ? true : false,
                'created_at' => $lead->created_at->timestamp,
                'created_at_o' => $lead->created_at->toDateTimeString(),
                'lastComment' => isset($lead->lastComment()->comment_value) ? $lead->lastComment()->comment_value : "",
            ),
            'history' => $lead->comments->transform(function ($item) {
                $item->load('status', 'user');
                return $item;
            })->toArray()
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLead $request, Lead $lead)
    {
        //check access
        $this->authorize('save', Lead::class);

        /** @var Lead $lead */
        $lead->count_create++;

        /** @var User $user */
        $user = Auth::user();

        /** @var Lead $tmp */
        $tmp = clone $lead;

        /** @var Status $status */
        $status = Status::where('title', 'new')->firstOrFail();

        //lead save
        $lead->fill($request->except('comment'));
        $lead->created_at = Carbon::now();
        $lead->status()->associate($status)->update();


        //first comment save
        if (!empty($request->text)) {
            $tmpText = "Пользователь <strong>" . $user->name . ' ' . $user->lastname . '</strong> оставил <strong>комментарий</strong> ' . (isset($request->text) ? $request->text : '');
            LeadCommentService::saveComment($tmpText, $lead, $user, $status);
        }

        //lead save status new
        /*if($status) {
            $lead->statuses()->attach($status->id,['created_at' => Carbon::now(),'updated_at' => Carbon::now()]);
        }*/

        //upate History
        if ($tmp->source_id != $lead->source_id) {
            //first comment save
            $is_event = true;/*признак события в лидах*/
            $tmpText = "Пользователь <strong>" . $user->name . ' ' . $user->lastname . '</strong> изменил <strong>источник</strong> на ' . $lead->source->title;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status,null,$is_event);
        }

        if ($tmp->unit_id != $lead->unit_id) {
            //first comment save
            $is_event = true;/*признак события в лидах*/
            $tmpText = "Пользователь <strong>" . $user->name . ' ' . $user->lastname . '</strong> изменил <strong>подразделение</strong> на ' . $lead->unit->title;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status,null,$is_event);
        }

        if ($tmp->status_id != $lead->status_id) {
            //first comment save
            $is_event = true;/*признак события в лидах*/
            $tmpText = "Пользователь <strong>" . $user->name . ' ' . $user->lastname . '</strong> изменил <strong>статус</strong> на ' . $lead->status->title_ru;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status,null,$is_event);
        }

        $is_event = true;/*признак события в лидах*/
        /**Автор лида* создал лид *дата и время создания* со статусом *статус**/
        $tmpText = "Автор <strong>" . $user->name . ' ' . $user->lastname . ' </strong>создал лид ' . Carbon::now() . ' <strong>со статусом</strong> ' . $status->title_ru;
        LeadCommentService::saveComment($tmpText, $lead, $user, $status, $request->text, $is_event);

        //send response
        return response()->json([
            'status' => 'success',
            'lead' => array(
                'count_create' => $lead->count_create,
                'link' => $lead->link,
                'phone' => $lead->phone,
                'source_title' => $lead->source->title,
                'source_id' => $lead->source->id,
                'unit_title' => $lead->unit->title,
                'unit_color' => $lead->unit->color,
                'id' => $lead->id,
                'is_processed' => $lead->is_processed ? true : false,
                'is_express_delivery' => $lead->is_express_delivery ? true : false,
                'is_add_sale' => $lead->is_add_sale ? true : false,
                'isQualityLead' => $lead->isQualityLead ? true : false,
                'created_at' => $lead->created_at->timestamp,
                'created_at_o' => $lead->created_at->toDateTimeString(),
                'lastComment' => isset($lead->lastComment()->comment_value) ? $lead->lastComment()->comment_value : "",

            )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateQuality(Request $request, Lead $lead)
    {
        //check access
        $this->authorize('edit', Lead::class);
        //update lead
        $lead->isQualityLead = "1";
        $lead->update();

        //send response
        return response()->json([
            'lead' => array(
                'count_create' => $lead->count_create,
                'link' => $lead->link,
                'phone' => $lead->phone,
                'source_title' => $lead->source->title,
                'source_id' => $lead->source->id,
                'unit_title' => $lead->unit->title,
                'unit_color' => $lead->unit->color,
                'id' => $lead->id,
                'author' => $lead->user->name,
                'status' => $lead->status->title_ru,
                'is_processed' => $lead->is_processed ? true : false,
                'is_express_delivery' => $lead->is_express_delivery ? true : false,
                'is_add_sale' => $lead->is_add_sale ? true : false,
                'isQualityLead' => $lead->isQualityLead ? true : false,
                'created_at' => $lead->created_at->toDateTimeString(),
                'created_at_o' => $lead->created_at,
                'lastComment' => isset($lead->lastComment()->comment_value) ? $lead->lastComment()->comment_value : "",


            )
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDddSalesCount() {

        /** @var int $count */
        $count = 0;
        /** @var User $user */
        $user = Auth::user();

        $count = $user->leads()->where('is_add_sale', '1')->where('isQualityLead', '1')->where(\DB::raw('DATE_FORMAT(created_at,"%Y-%m-%d")'), '>', \DB::raw('DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)'))->count();

        return response()->json([
            'count' => $count
        ]);
    }

    private function robot_id(){
        return User::where('email','automatic@bleecer.uk')->first()->id;
    }
}
