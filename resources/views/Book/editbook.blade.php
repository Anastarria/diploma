@extends('layout')
@section('content')
    <div class="container">
        <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        @if($book[0]->cover)
                            <img src="{{ asset('storage/book_covers/'.$book[0]->cover) }}" width="150" height="350" alt="Cover">
                        @else
                            <img src="{{ asset('storage/book_covers/no-cover.jpg')}}" width="150" height="350" alt=Cover>
                        @endif
                        <div class="mt-3">
                            <h4>Обложка</h4>
                            <form action="/books/edit/cover/{{$book[0]->id}}" method="post" enctype="multipart/form-data">
                                <input type="file"  name="cover">
                                <button class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Обновить обложку</button>
                            </form>
                            <form action="/books/delete/{{$book[0]->id}}" method="post" enctype="multipart/form-data">
                                <button class="btn btn-danger" ><i class="far fa-trash-alt"></i> Удалить книгу</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
            <div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert" id="error" style="display: none">
                                An error occurred
                            </div>
                            <div class="row">
                                <div id="loader" style="display: none">Processing...</div>

                                <div id="success" class="alert alert-success" role="alert" style="display:none">Changed successfully</div>



                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div id="changeName" style="display: none" class="col-sm-9 text-secondary">
                                    <input type="text" id="title" placeholder="{{$book[0]->title}}"><br>
                                    <a onclick="editBook()"><i class="fas fa-check"></i>Сохранить изменения</a>
                                    <a onclick="hideEditTitle()"><i class="fas fa-times"></i>Отменить</a>
                                </div>
                                <div id="showName" style="display: block">{{$book[0]->title}}<a onclick="showEditTitle()"><i class="fas fa-pencil-alt"></i> Редактировать</a> </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Author</h6>
                            </div>
                            <div id="changeAuthor" style="display: none"  class="col-sm-9 text-secondary">
                                <input type="text" id="author" placeholder="{{$book[0]->author}}"><br>
                                <a onclick="editProfile()">  <i class="fas fa-check"></i> Сохранить изменения</a>
                                <a onclick="hideEditAuthor()"><i class="fas fa-times"></i>Отменить</a>
                            </div>
                            <div id="showAuthor" style="display: block">{{$book[0]->author}}<a onclick="showEditAuthor()"><i class="fas fa-pencil-alt"></i> Редактировать</a> </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Genre</h6>
                            </div>
                            <div id="changeGenre" style="display: none" class="col-sm-9 text-secondary">
                                <input type="password" id="genre" placeholder="{{$book[0]->genre}}"><br>
                                <a  onclick="editProfile()"><i class="fas fa-check"></i>   Сохранить изменения</a>
                                <a onclick="hideEditGenre()"><i class="fas fa-times"></i>Отменить</a>
                            </div>
                            <div id="showGenre" style="display: block">{{$book[0]->author}}<a onclick="showEditGenre()"><i class="fas fa-pencil-alt"></i> Редактировать</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Description</h6>
                            </div>
                            <div id="changeDescription" style="display: none" class="col-sm-9 text-secondary">
                                <input type="text" id="description"><br>
                                <a  onclick="editProfile()"><i class="fas fa-check"></i>   Сохранить изменения</a>
                                <a onclick="hideEditDescription()"><i class="fas fa-times"></i>Отменить</a>
                            </div>
                            <div id="showDescription" style="display: block">{{$book[0]->description}}<a onclick="showEditDescription()"><i class="fas fa-pencil-alt"></i>Редактировать</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
    </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/editbook.js') }}" ></script>
    @endpush
@endsection
