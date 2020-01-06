<?php

namespace App\Modules\Admin\TaskComment\Controllers\Api;


use App\Modules\Admin\Lead\Models\Status;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\TaskComment\Models\TaskComment;
use App\Modules\Admin\TaskComment\Services\TaskCommentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TasksCommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check access
        $this->authorize('edit', TaskComment::class);

        /** @var Task $task */
        $task = Task::findOrFail($request->task_id);
        if($task) {

            /** @var Status $status */
            $status = Status::findOrFail($request->status_id);

            /** @var User $user */
            $user = Auth::user();

            $task->responsible_id = $request->responsible_id;

            if($request->status_id != $task->status_id) {
                //update lead
                $task->status()->associate($status);
                //$lead->statuses()->attach($status->id,['created_at' => Carbon::now(),'updated_at' => Carbon::now()]);

                //first comment save
                $tmpText = "Пользователь <strong>" . $user->firstname.' '.$user->lastname . '</strong> изменил <strong>статус</strong> на '. $status->title_ru;
                TaskCommentService::saveComment($tmpText, $task, $user, $status);

            }

            //save task
            $task->update();

            //first comment save
            if(isset($request->text) && $request->text != "") {
                $tmpText = "Пользователь <strong>" . $user->firstname.' '.$user->lastname . '</strong> оставил <strong>комментарий</strong> '. $request->text;
                TaskCommentService::saveComment($tmpText, $task, $user, $status, $request->text);

            }

        }

        //send response
        return response()->json([
            'status' => 'success',
            'task' => array(
                'link'  => $task->link,
                'phone'  => $task->phone,
                'source_title' => isset($task->source->title) ? $task->source->title : "",
                'source_id' => isset($task->source->id) ? $task->source->id : "",
                'unit_title' => isset($task->unit->title) ? $task->unit->title : "",
                'unit_color' => isset($task->unit->color) ? $task->unit->color : "",
                'responsible_id' => $task->responsible_id,
                'id'  => $task->id,
                'status' => $task->status->id,
                'status_id' => $task->status->id,
                'author' => $task->user->firstname,
                'created_at' => $task->created_at->toDateTimeString(),
                'created_at' => $task->created_at->timestamp,
                'created_at_o' => $task->created_at->toDateTimeString(),
                'lastComment' => isset($task->lastComment()->comment_value) ? $task->lastComment()->comment_value : "",
            )
        ]);
    }
}
