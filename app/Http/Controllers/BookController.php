<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BookController
{


    public function showSingleBook($id, Request $request): View
    {

        $book = Book::query()
            ->where('id', '=', $id)
            ->get();

        $comments = Comment::query()
            ->get()
            ->toArray();

        $auth = $request->user();

        $bookmarks = Bookmark::query()
            ->where('book_id', '=', $id)
            ->where('user_id', '=', $auth->id)
            ->get()
            ->toArray();

//        print_r($bookmarks);
//        die();

        return view('Book.singlebook', [
            'book' => $book,
            'comments' => $comments,
            'auth' => $auth,
            'bookmarks' => $bookmarks
        ]);
    }

    public function createBookPage(): View
    {
        return view('Book.createbook');
    }

    public function createBook(CreateBookRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();

        $cover = $request->file('cover')->getClientOriginalName();
        $path = $request->file('path_to_book')->getClientOriginalName();

        Storage::putFileAs(
            'public/books', $request->file('path_to_book'), $path
        );
        Storage::putFileAs(
            'public/book_covers', $request->file('cover'), $cover
        );


        $book = new Book();
        $book->title = $validated['title'];
        $book->author = $validated['author'];
        $book->genre = $validated['genre'];
        $book->description = $validated['description'];
        $book->added_by = $user->name;
        $book->cover = $cover;
        $book->path_to_book = $path;


        $book->save();

        return redirect('/');
    }

    public function updateBookPage(): View
    {
        return view('Book.editbook');
    }

    public function updateBook()
    {
    }

    public function deleteBook()
    {

    }


}
