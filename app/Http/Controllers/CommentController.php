<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CommentController extends Controller
{


    public function createComment(CreateCommentRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();

        if (!$user){
            return response()
                ->json("You have to be logged in to be able to leave comments", Response::HTTP_UNAUTHORIZED);
        }

        $comment = new Comment();
        $comment->added_by = $user->nickname;
        $comment->text = $validated['comment'];
        $comment->book_id = $validated['book'];

        $comment->save();

        return redirect('/books/info/'.$validated['book']);
    }

    public function deleteComment($id, Request $request)
    {
        $comment = Comment::query()
            ->where('id', '=', $id)
            ->first();

        if (!$request->user() || !$request->user()->nickname === $comment->added_by){
            return response()
                ->json("You can delete only your own comments", Response::HTTP_UNAUTHORIZED);
        }

        if (!$comment) {
            return response()->json(['error' => 'No such comment'], Response::HTTP_NOT_FOUND);
        }

        $comment->delete();

        return redirect('/');
    }

}
