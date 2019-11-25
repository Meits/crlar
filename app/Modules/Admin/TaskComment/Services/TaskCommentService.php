<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 25-Mar-19
 * Time: 14:20
 */

namespace App\Modules\Admin\TaskComment\Services;


use App\Modules\Admin\Lead\Models\Status;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\TaskComment\Models\TaskComment;
use App\Modules\Admin\User\Models\User;

class TaskCommentService
{
    /**
     * Save lead comment
     *
     * @param string $text
     * @param Lead $lead
     * @param User $user
     * @param Status $status
     * @return LeadComment
     */
    public static function saveComment(string $text, Task $task, User $user, Status $status, string $commentValue = null) {

        /** @var LeadComment $comment */
        $comment = new TaskComment();
        //first comment save
        $comment->text = $text;
        $comment->comment_value = $commentValue;
        $comment
            ->task()
            ->associate($task)
            ->user()
            ->associate($user)
            ->status()
            ->associate($status)
            ->save();

        return $comment;
    }
}