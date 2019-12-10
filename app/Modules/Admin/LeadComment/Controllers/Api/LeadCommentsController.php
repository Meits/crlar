<?php

namespace App\Modules\Admin\LeadComment\Controllers\Api;


use App\Modules\Admin\Lead\Models\Status;
use App\Modules\Admin\User\Models\User;
use App\Modules\Lead\Models\Lead;
use App\Modules\LeadComment\Models\LeadComment;
use App\Modules\LeadComment\Services\LeadCommentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeadCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check access
        $this->authorize('edit', LeadComment::class);

        /** @var Lead $lead */
        $lead = Lead::findOrFail($request->lead_id);
        if($lead) {

            if(!empty($request->status_id)) {
                /** @var Status $status */
                $status = Status::findOrFail($request->status_id);
            }

            /** @var User $user */
            $user = Auth::user();

            if(!empty($request->status_id) && $request->status_id != $lead->status_id) {
                /*$bot_id = User::where('email','automatic@bleecer.uk')->first()->id;
                //update lead
                if ($lead->user_id == $bot_id){
                    $lead->user_id = $user->id;
                }*/

                $lead->status()->associate($status)->update();
                //$lead->statuses()->attach($status->id,['created_at' => Carbon::now(),'updated_at' => Carbon::now()]);
                $is_event = true;/*признак события в лидах*/

                //first comment save
                $tmpText = "Пользователь <strong>" . $user->name.' '.$user->lastname . '</strong> изменил <strong>статус</strong> на '. $status->title_ru;
                LeadCommentService::saveComment($tmpText, $lead, $user, $status,null, $is_event);

            }

            if(!empty($request->user_id ) && $request->user_id != $lead->user_id) {
                //update lead
                $author_change = User::findOrfail($request->user_id);
                $lead->user()->associate($author_change)->update();
                //$lead->statuses()->attach($status->id,['created_at' => Carbon::now(),'updated_at' => Carbon::now()]);
                $is_event = true;/*признак события в лидах*/
                //first comment save
                $tmpText = "Пользователь <strong>" . $user->name.' '.$user->lastname . '</strong> изменил <strong>автора</strong> на '. $author_change->name;
                LeadCommentService::saveComment($tmpText, $lead, $user, $status,null, $is_event);

            }

            //first comment save
            if(isset($request->text) && $request->text != "") {
                $tmpText = "Пользователь <strong>" . $user->name.' '.$user->lastname . '</strong> оставил <strong>комментарий</strong> '. $request->text;
                LeadCommentService::saveComment($tmpText, $lead, $user, $status, $request->text);

            }

        }

        //send response
        return response()->json([
            'status' => 'success',
            'lead' => array(
                'count_create' => $lead->count_create,
                'link' => $lead->link,
                'phone' => $lead->phone,
                'source_title' => $lead->source ? $lead->source->title : "",
                'source_id' => $lead->source ? $lead->source->id : "",
                'unit_id' => $lead->unit ? $lead->unit->id : "",
                'unit_title' => $lead->unit ? $lead->unit->title : "",
                'unit_color' => $lead->unit ? $lead->unit->color : "",
                'status_id' => $lead->status_id,
                'id' => $lead->id,
                'id_source' => $lead->source_id,
                'created_at' => $lead->created_at->timestamp,
                'created_at_o' => $lead->created_at->toDateTimeString(),
                'updated_at' => $lead->update_at,
                'is_processed' => $lead->is_processed ? true : false,
                'is_express_delivery' => $lead->is_express_delivery ? true : false,
                'is_add_sale' => $lead->is_add_sale ? true : false,
                'isQualityLead' => $lead->isQualityLead ? true : false,
                'user_id' => $lead->user_id,
                'lastComment' => isset($lead->lastComment()->comment_value) ? $lead->lastComment()->comment_value : "",
            )
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
