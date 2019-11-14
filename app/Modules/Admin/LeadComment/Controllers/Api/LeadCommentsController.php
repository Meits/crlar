<?php

namespace App\Modules\LeadComment\Controllers\Api;

use App\Models\Lead;
use App\Models\LeadComment;
use App\Models\Status;
use App\Models\User;
use App\Services\LeadCommentService;
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
        $lead = Lead::findOrFail($request->leadId);
        if($lead) {

            if(!empty($request->status_id)) {
                /** @var Status $status */
                $status = Status::findOrFail($request->status_id);
            }

            /** @var User $user */
            $user = Auth::user();

            if(!empty($request->status_id) && $request->status_id != $lead->status_id) {
                $bot_id = User::where('email','automatic@bleecer.uk')->first()->id;
                //update lead
                if ($lead->user_id == $bot_id){
                    $lead->user_id = $user->id;
                }

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
                'link'  => $lead->link,
                'phone'  => $lead->phone,
                'source_title'  => $lead->source->title,
                'source_id'  => $lead->source->id,
                'unit_title'  => $lead->unit->title,
                'status' =>$lead->status->id,
                'id'  => $lead->id,
                'created_at' => $lead->created_at->toDateTimeString(),
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
