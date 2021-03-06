<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 01-Nov-18
 * Time: 16:46
 */

namespace App\Modules\LeadComment\Services;


use App\Modules\Admin\Lead\Models\Status;
use App\Modules\Admin\User\Models\User;
use App\Modules\Lead\Models\Lead;
use App\Modules\LeadComment\Models\LeadComment;
use phpDocumentor\Reflection\Types\Boolean;

class LeadCommentService
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
    public static function saveComment(string $text, Lead $lead, User $user, Status $status, string $commentValue = null, bool $is_event = false)
    {

        /** @var LeadComment $comment */
        $comment = new LeadComment();
        //first comment save
        $comment->text = $text;
        $comment->comment_value = $commentValue;
        $comment->is_event = $is_event;
        $comment
            ->lead()
            ->associate($lead)
            ->user()
            ->associate($user)
            ->status()
            ->associate($status)
            ->save();

        return $comment;
    }
}
