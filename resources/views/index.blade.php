@extends('layout')
@section('content')
    <div class="card-deck container">
        @foreach($books as $book)

        <div class="card col-md-4 mb-3 book-card">
            @if($book['cover'])
                <img src="{{ asset('storage/book_covers/'.$book['cover']) }}" width="200" height="350" alt="Cover">
            @else
                <img src="{{ asset('storage/book_covers/no-cover.jpg')}}" width="150" height="250" alt=Cover>
            @endif

            <div class="card-body">
                <h5 class="card-title">{{$book['title']}}</h5>
                <p class="card-text">{{$book['description']}}</p>
                <p class="card-text"><small class="text-muted">Written by: {{$book['author']}}</small></p>
            </div>
                <form action="/books/info/{{$book['id']}}" >
                    <button class="btn btn-primary " >Больше инфо</button>
                </form>
        </div>
        <div class="col-md-1">
        </div>



@endforeach
    </div>
@endsection
