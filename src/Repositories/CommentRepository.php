<?php

namespace Story\Tasking\Repositories;

use Story\Tasking\Comment;
use Story\Tasking\Contracts\CommentRepositoryInterface;
use Story\Tasking\Issue;
use Illuminate\Contracts\Auth\Authenticatable;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * Create a new comment for given issue
     *
     * @param Issue $issue
     * @param User $user
     * @param array $data
     * @return void
     */
    public function create(Issue $issue, Authenticatable $user, array $data)
    {
        return Comment::create([
            'issue_id' => $issue->id,
            'user_id' => $user->id,
            'comment' => $data['comment']
        ]);
    }

    /**
     * Update a comment from given comment instance.
     *
     * @param Comment $comment
     * @param array $data
     * @return void
     */
    public function update(Comment $comment, array $data)
    {
        $comment->comment = $data['comment'];

        return $comment->save();
    }

    /**
     * Delete a comment instance.
     *
     * @param Comment $coment
     * @return void
     */
    public function delete(Comment $coment)
    {
        return $comment->delete();
    }

    /**
     * Get the comment from given comment ID
     *
     * @param Issue $issue
     * @param [type] $commentID
     * @return void
     */
    public function getComment(Issue $issue, $commentID)
    {
        return $issue->comment()->with('user')->findOrFail($commentID);
    }

    /**
     * Get all comment from given issue ID
     *
     * @param Issue $issue
     * @return void
     */
    public function getAllCommentsForIssue(Issue $issue)
    {
        return $issue->comment()->with('user')->get();
    }
}
