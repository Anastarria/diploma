@extends('layout')
@section('content')
    <div class="container">
            <ul class="nav navbar-nav justify-content-center">
                <li><form method="post" action="/books/genre/Фентези"><button id="genre" name="genre" type="submit">Фентези</button></form></li>
                <li><form method="post" action="/books/genre/Научная Фантастика"><button id="genre" name="genre" type="submit">Научная Фантастика</button></form></li>
                <li><form method="post" action="/books/genre/Детектив"><button id="genre" name="genre" type="submit">Детектив</button></form></li>
                <li><form method="post" action="/books/genre/Роман"><button id="genre" name="genre" type="submit">Роман</button></form></li>
                <li><form method="post" action="/books/genre/Приключения"><button id="genre" name="genre" type="submit">Приключения</button></form></li>
            </ul>

    </div>
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
