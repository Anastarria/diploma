<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\EditBookRequest;
use App\Models\Book;
use App\Models\Bookmark;
use App\Models\Comment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class BookController
{

    public function index()
    {
        $books = Book::query()
            ->get()
            ->toArray();


        return view('index', [
            'books' => $books
        ]);
    }

    public function showSingleBook($id, Request $request): View
    {

        $auth = $request->user();


        $book = Book::query()
            ->where('id', '=', $id)
            ->get();

        $comments = Comment::query()
            ->where('book', '=', $id)
            ->get()
            ->toArray();

        $bookmarks = Bookmark::with(['book'])
            ->with(['user'])
            ->where('book_id', '=', $id)
            ->get()
            ->toArray();

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

    public function createBookPage2($title): View
    {
        return view('Book.createbook_step2', [
            'title' => $title
        ]);
    }

    public function createBook(CreateBookRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();

        $book = new Book();

        $book->title = $validated['title'];
        $book->author = $validated['author'];
        $book->genre = $validated['genre'];
        $book->description = $validated['description'];
        $book->added_by = $user->name;

        $book->save();

//        return view('Book.createbook_step2', [
//            'book_title' => $book->title
//        ]);

    }

    public function updateBookPage($id): View
    {
        $book = Book::query()
            ->where('id', '=', $id)
            ->get();

        return view('Book.editbook', [
            'book' => $book
        ]);
    }

    public function sortByGenre($genre):View
    {
        $books = Book::query()
            ->where('genre', '=', $genre)
            ->get()
            ->toArray();

        return view('index', [
            'books' => $books
        ]);
    }

    public function updateBook(EditBookRequest $request, $id)
    {
        $validated = $request->validated();
        $user = $request->user();

        $book = Book::query()
            ->where('id', '=', $id)
            ->first();

        $book->title = $validated['title'] ?? $book->title;
        $book->author = $validated['author'] ?? $book->author;
        $book->genre = $validated['genre'] ?? $book->genre;
        $book->description = $validated['description'] ?? $book->description;
        $book->added_by = $user->name ?? $book->added_by;

        $book->save();

        return redirect('/');
    }

    public function changeCover($id, EditBookRequest $request)
    {
        $cover = $request->file('cover')->getClientOriginalName();
        $book = Book::query()
            ->where('id', '=', $id)
            ->first();
        Storage::putFileAs(
            'public/book_covers', $request->file('cover'), md5(time()) . '.' . $cover
        );
        $book->cover = md5(time()) . '.' . $cover;
        $book->save();

        return redirect('/books/edit/'.$id);
    }

    public function uploadBookFiles($title, EditBookRequest $request)
    {
        $validated = $request->validated();
        $book = Book::query()
            ->where('title', '=', $title)
            ->first();

        $this->changeCover($book->id, $request);
        $this->changeBookFile($book->id, $request);


        return redirect('/');
    }

    public function changeBookFile($id, EditBookRequest $request)
    {
        $cover = $request->file('path_to_book')->getClientOriginalName();
        $book = Book::query()
            ->where('id', '=', $id)
            ->first();
        Storage::putFileAs(
            'public/books', $request->file('path_to_book'), md5(time()) . '.' . $cover
        );
        $book->path_to_book = md5(time()) . '.' . $cover;
        $book->save();

        return redirect('/books/edit/'.$id);
    }

    public function deleteBook($id)
    {
        $book = Book::query()
            ->where('id', '=', $id)
            ->first();

        if (!$book) {
            return response()->json(['error' => 'No such book'], Response::HTTP_NOT_FOUND);
        }

        $bookMarks = Bookmark::query()
            ->where('book_id', '=', $id)
            ->get();
        foreach ($bookMarks as $bookMark) {
            $bookMark->delete();
        }

        Storage::delete(
            'public/books/'.$book->path_to_book);
        Storage::delete(
            'public/book_covers/'.$book->cover);


        $book->delete();

        return redirect('/');
    }


}
