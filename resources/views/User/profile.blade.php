@extends('layout')
@section('content')

    <div class="container"><h3>Profile </h3></div>

    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @if($user->path_to_avatar)
                                    <img src="{{ asset('storage/avatars/'.$user->path_to_avatar) }}" width="200" height="200" alt="Avatar">
                                @else
                                    <img src="{{ asset('storage/avatars/no-avatar.png')}}" width="250" height="250" alt="Avatar">
                                @endif
                                <div class="mt-3">
                                    <h4>{{$user->nickname}}</h4>

                                    <a class="btn btn-primary" href="/profile/edit">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$user->name}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$user->email}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    ************
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    @foreach($books as $book)
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="card gradient-card">

                                        <div class="card-body white" id="removeBookmark">
                                            <h4 class="text-uppercase font-weight-bold my-4">{{$book['book']['title']}}</h4>
                                            <input name="book_id" id="book_id" type="hidden" value="{{$book['book']['id']}}">
                                            <input name="user_id" id="user_id" type="hidden" value="{{$user->id}}">
                                            <input type="hidden" class="display: none" id="addBookmark">
                                            <a href="/books/info/{{$book['book']['id']}}" class="btn btn-success"><i class="far fa-bookmark"></i>К книге</a>
                                            <button  type="submit" id="removeBookmark" name="submit" class="btn btn-warning" onclick="removeBookmark()"><i class="far fa-bookmark"></i> Убрать из закладок</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/bookmark.js') }}" ></script>
    @endpush
@endsection
