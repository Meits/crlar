<?php

namespace App\Modules\Admin\Task\Controllers\Api;

use App\Modules\Admin\Lead\Models\Status;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\Task\Requests\TaskRequest;
use App\Modules\Admin\TaskComment\Services\TaskCommentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check access
        $this->authorize('view', Task::class);
        //DB::enableQueryLog();

        /** @var Collection $tasks */
        $tasks = new Task();
        $tasks = $tasks->getTasks(Auth::user());

        //print_r(DB::getQueryLog());

        /** @var Collection $statuses */
        $statuses = Status::all();

        /** @var Array $resultTasks */
        $resultTasks = [];
        $statuses->each(function ($item, $key) use (&$resultTasks, $tasks) {
            $collection = $tasks->where('status_id', $item->id);
            $resultTasks[$item->title] = $collection->map(function ($item) {
                return array(
                    'link' => $item->link,
                    'phone' => $item->phone,
                    'source_title' => $item->source ? $item->source->title : "",
                    'source_id' => $item->source ? $item->source->id : "",
                    'unit_title' => $item->unit ? $item->unit->title : "",
                    'unit_color' => $item->unit ? $item->unit->color : "",
                    'id' => $item->id,
                    'id_source' => $item->source_id,
                    'user_id' => $item->user_id,
                    'author' => $item->user->name,
                    'responsible_id' => $item->responsible_id,
                    'created_at' => $item->created_at->timestamp,
                    'created_at_o' => $item->created_at->toDateTimeString(),
                    'updated_at' => $item->update_at,
                    'lastComment' => isset($item->lastComment()->comment_value) ? $item->lastComment()->comment_value : "",
                );
            })->toArray();
            $resultTasks[$item->title] = array_values($resultTasks[$item->title]);
        });

        //send response
        return response()->json([
            'tasks' => $resultTasks

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        //check access
        $this->authorize('view', Task::class);

        /** @var Collection $tasks */
        $tasks = new Task();
        $tasks = $tasks->getArchives(Auth::user());

        //print_r($leads);

        /** @var Array $resultTasks */
        $resultTasks = [];
        $resultTasks = $tasks->map(function ($item) {
            return array(
                'link' => $item->link,
                'phone' => $item->phone,
                'source_title' => $item->source ? $item->source->title : "",
                'source_id' => $item->source ? $item->source->id : "",
                'unit_title' => $item->unit ? $item->unit->title : "",
                'unit_color' => $item->unit ? $item->unit->color : "",
                'id' => $item->id,
                'id_source' => $item->source_id,
                'user_id' => $item->user_id,
                'author' => $item->user->name,
                'responsible_id' => $item->responsible_id,
                'created_at' => $item->created_at->timestamp,
                'created_at_o' => $item->created_at->toDateTimeString(),
                'updated_at' => $item->updated_at->toDateTimeString(),
                'lastComment' => isset($item->lastComment()->comment_value) ? $item->lastComment()->comment_value : "",

            );
        })->toArray();
        $resultTasks = array_values($resultTasks);


        //send response
        return response()->json([
            'tasks' => $resultTasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        //check access
        $this->authorize('save', Task::class);

        /** @var Lead $task */
        $task = new Task();

        /** @var User $user */
        $user = Auth::user();

        /** @var Status $status */
        $status = Status::where('title', 'new')->firstOrFail();

        //lead save
        $user
            ->tasks()
            ->save($task->fill($request->except('comment'))->status()->associate($status));

        //first comment save
        if (isset($request->text) && $request->text != "") {
            $tmpText = "Пользователь <strong>" . $user->name . ' ' . $user->lastname . '</strong> оставил <strong>комментарий</strong> ' . $request->text;
            TaskCommentService::saveComment($tmpText, $task, $user, $status, $request->text);
        }

        //send response
        return response()->json([
            'status' => 'success',
            'task' => array(
                'link' => $task->link,
                'phone' => $task->phone,
                'source_title' => isset($task->source->title) ? $task->source->title : "",
                'source_id' => isset($task->source->id) ? $task->source->id : "",
                'unit_title' => isset($task->unit->title) ? $task->unit->title : "",
                'unit_color' => isset($task->unit->color) ? $task->unit->color : "",
                'user_id' => $task->user_id,
                'author' => $task->user->name,
                'responsible_id' => $task->responsible_id,
                'id' => $task->id,
                'created_at' => $task->created_at->timestamp,
                'created_at_o' => $task->created_at->toDateTimeString(),
                'lastComment' => isset($task->lastComment()->comment_value) ? $task->lastComment()->comment_value : "",

            )
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //check access
        $this->authorize('view', Task::class);
        //
        return response()->json([
            'task' => array(
                'link' => $task->link,
                'phone' => $task->phone,
                'source_title' => isset($task->source->title) ? $task->source->title : "",
                'source_id' => isset($task->source->id) ? $task->source->id : "",
                'unit_title' => isset($task->unit->title) ? $task->unit->title : "",
                'unit_color' => isset($task->unit->color) ? $task->unit->color : "",
                'id' => $task->id,
                'author' => $task->user->name,
                'responsible_id' => $task->responsible_id,
                'status' => $task->status->title_ru,
                'status_id' => $task->status->id,
                'created_at' => $task->created_at->timestamp,
                'created_at_o' => $task->created_at->toDateTimeString(),
                'lastComment' => isset($task->lastComment()->comment_value) ? $task->lastComment()->comment_value : "",



            ),
            'history' => $task->comments->transform(function ($item) {
                $item->load('status', 'user');
                return $item;
            })->toArray()
        ]);

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
