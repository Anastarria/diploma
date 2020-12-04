<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Response;


class CommentController
{


    public function createComment(CreateCommentRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();

        $comment = new Comment();
        $comment->added_by = $user->nickname;
        $comment->text = $validated['comment'];
        $comment->book = $validated['book'];

        $comment->save();

        return redirect('/books/info/'.$validated['book']);
    }

    public function deleteComment($id)
    {
        $comment = Comment::query()
            ->where('id', '=', $id)
            ->first();

        if (!$comment) {
            return response()->json(['error' => 'No such comment'], Response::HTTP_NOT_FOUND);
        }

        $comment->delete();

        return redirect('/');
    }

}
