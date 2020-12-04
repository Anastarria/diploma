@extends('layout')
@section('content')
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    @if($book[0]->cover)
                                        <img src="{{ asset('storage/book_covers/'.$book[0]->cover) }}" width="150" height="350" alt="Cover">
                                    @else
                                        <img src="{{ asset('storage/book_covers/no-cover.jpg')}}" width="150" height="350" alt=Cover>
                                    @endif
                                </div>


                            </div>
                            <div class="about">
                                <h3>{{$book[0]->title}}</h3>
                                <h5 class="mb-2 text-primary">Информация о книге</h5>
                                <ul class="nav navbar-nav justify-content-center" >

                                        <div>Автор: {{$book[0]->author}}</div>
                                        <div>Жанр:{{$book[0]->genre}}</div>
                                    <div class="text-right" style="display: block" >
                                        <button type="button" id="submit" name="submit" class="btn btn-primary"><i class="fas fa-book"></i> Читать </button>
                                        @if(!$bookmarks)
                                        <div id="addBookmark">
                                            <input name="book_id" id="book_id" type="hidden" value="{{$book[0]->id}}">
                                            <input name="user_id" id="user_id" type="hidden" value="{{$auth->id}}">
                                            <button  type="submit" id="removeBookmark" name="submit" class="btn btn-warning" onclick="removeBookmark()" style="display: none"><i class="far fa-bookmark"></i> Убрать из закладок</button>
                                            <button  type="submit" id="addBookmark" name="submit" class="btn btn-success" onclick="addBookmark()"><i class="far fa-bookmark"></i> Добавить в закладки</button>
                                        </div>


                                        @else
                                        <div >
                                            <input name="book_id" id="book_id" type="hidden" value="{{$book[0]->id}}">
                                            <input name="user_id" id="user_id" type="hidden" value="{{$auth->id}}">
                                            <button  type="submit" id="addBookmark" name="submit" class="btn btn-success" onclick="addBookmark()" style="display: none"><i class="far fa-bookmark"></i> Добавить в закладки</button>
                                            <button  type="submit" id="removeBookmark" name="submit" class="btn btn-warning" onclick="removeBookmark()"><i class="far fa-bookmark"></i> Убрать из закладок</button>
                                        </div>

                                        @endif
                                    </div>
                                </ul>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h3>Описание</h3>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    {{$book[0]->description}}
                                </div>
                            </div>

                        </div>
                        @if ($user = \Illuminate\Support\Facades\Auth::user())
                        <form method="post" action="/books/comment/create">
                            <input name="book" id="book" type="hidden" value="{{$book[0]->id}}">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Добавить комментарий</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                    </div>

                                        <div class="text-right">
                                            <button type="submit" id="submit" name="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i> Добавить</button>
                                        </div>
                                </div>
                            </div>
                        </form>
                        @endif

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div><h4>Комментарии пользователей</h4></div>

                            @foreach($comments as $comment)
                                <div class="card">
                                    <div> <span class="badge badge-pill>">{{$comment['added_by']}}</span> <span class="text-right badge badge-pill>">{{$comment['created_at']}}</span>  </div>
                                    <div class="card-body">
                                        <div class="news-title">
                                            {{$comment['text']}}
                                        </div>

                                    </div>
                                    @if($comment['added_by'] == $auth->nickname)
                                    <form class="text-right" action="/books/comment/delete/{{$comment['id']}}" method="post" enctype="multipart/form-data">
                                        <button class="btn btn-danger fa fa-trash-alt" >Удалить</button>
                                    </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/bookmark.js') }}" ></script>
    @endpush
@endsection
