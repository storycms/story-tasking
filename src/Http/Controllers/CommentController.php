<?php

namespace Story\Tasking\Http\Controllers;

use Illuminate\Http\Request;
use Story\Tasking\Contracts\IssueRepositoryInterface;
use Story\Tasking\Contracts\CommentRepositoryInterface;

class CommentController extends Controller
{
    /**
     * The issues repository implementation.
     *
     * @var \Story\Tasking\Contracts\IssueRepositoryInterface
     */
    protected $issues;

    /**
     * The comments repository implementation.
     *
     * @var \Story\Tasking\Contracts\CommentRepositoryInterface
     */
    protected $comments;

    /**
     * Create new controller instance.
     *
     * @param \Story\Tasking\Contracts\IssueRepositoryInterface   $issues
     * @param \Story\Tasking\Contracts\CommentRepositoryInterface $comments
     */
    public function __construct(IssueRepositoryInterface $issues, CommentRepositoryInterface $comments)
    {
        $this->middleware('auth');

        $this->issues = $issues;
        $this->comments = $comments;
    }

    /**
     * Show all comment for given issue Id
     *
     * @param \Illuminate\Http\Request $request
     * @param int $issueID
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $issueID)
    {
        $issue = $this->issues->getIssue($request->user(), $issueID);
        $comments = $this->comments->getAllCommentsForIssue($issue);

        return response()->json(['data' => $comments]);
    }

    /**
     * Create a new comment
     *
     * @param \Illuminate\Http\Request $request
     * @param int $issueID
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $issueID)
    {
        $user = $request->user();
        $issue = $this->issues->getIssue($user, $issueID);
        $comment = $this->comments->create($issue, $user, $request->all());

        if ($comment) {
            return response()->json(['data' => $comment->load('user') ]);
        }
        return response()->json([], 422);
    }

    /**
     * Update a comment form given comment ID
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int     $issueID
     * @param  int     $commentID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $issueID, int $commentID)
    {
        $user = $request->user();
        $issue = $this->issues->getIssue($user, $issueID);
        $comment = $this->comments->getComment($issue, $commentID);

        if ($this->comments->update($comment, $request->all())) {
            return response()->json(['data' => $comment->fresh('user') ]);
        }
        return response()->json([], 422);
    }

    /**
     * Destroy a comment from given commentID
     *
     * @param  Request $request
     * @param  int     $issueID
     * @param  int     $commentID
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $issueID, int $commentID)
    {
        $user = $request->user();
        $issue = $this->issues->getIssue($user, $issueID);
        $comment = $this->comments->getComment($issue, $commentID);

        if ($this->comments->delete($comment)) {
            return response()->json([]);
        }
        return response()->json([], 422);
    }
}
