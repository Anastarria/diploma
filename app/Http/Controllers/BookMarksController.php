<?php


namespace App\Http\Controllers;


use App\Http\Requests\CreateBookmarkRequest;
use App\Models\Book;
use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookMarksController
{
    public function addBookmark(CreateBookmarkRequest $request)
    {
        $data = $request->validated();

        $bookmark = new Bookmark();
        $bookmark->user_id = $data['user_id'];
        $bookmark->book_id = $data['book_id'];
        $bookmark->save();

    }

    public function removeBookmark(CreateBookmarkRequest $request)
    {
        $data = $request->validated();

        $user_id = $data['user_id'];
        $book_id = $data['book_id'];

        $bookmark = Bookmark::query()
            ->where('user_id', '=', $user_id)
            ->where('book_id', '=', $book_id)
            ->first();

        $bookmark->delete();
    }
}
