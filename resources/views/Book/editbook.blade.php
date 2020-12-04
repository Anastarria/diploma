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
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Maxwell Admin">
                            </div>
                            <h6>Add author name here</h6>
                            <h4>Add Book Title Here</h4>

                        </div>
                        <div class="about">
                            <h5>Информация о книге</h5>
                            <ul class="nav navbar-nav" >
                                <div><a href="/support">Автор:</a></div>
                                <div><a href="/register">Жанр:</a></div>

                            </ul>
                            <div class="text-left">
                                <form action="/editavatar" method="post" enctype="multipart/form-data">
                                    <input type="file"  name="path_to_avatar">
                                    <button class="btn btn-success fa fa-cloud-upload" >Обновить аватар</button>
                                </form>
                                <form action="/deleteavatar" method="post" enctype="multipart/form-data">
                                    <button class="btn btn-danger fa fa-trash-alt" >Удалить</button>
                                </form>
                            </div>

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
                            <h3>Book info</h3>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="exampleFormControlInput1">Название книги</label><a>  <i class="fas fa-check"></i>   Сохранить изменения</a>
                            <div style="display: block">Book Name <i class="fas fa-pencil-alt"></i> </div>
                            <input type="text" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="exampleFormControlInput1">Автор</label>
                            <div style="display: block">Aurhor Name<i class="fas fa-pencil-alt"></i> </div>
                            <input type="text" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="exampleFormControlSelect1">Жанр</label>
                            <div style="display: block">Genre<i class="fas fa-pencil-alt"></i> </div>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Фентези</option>
                                <option>Научная Фантастика</option>
                                <option>Детектив</option>
                                <option>Роман</option>
                                <option>Приключения</option>
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="exampleFormControlFile1">Обложка</label>
                            <div style="display: block">Cover<i class="fas fa-pencil-alt"></i> </div>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="exampleFormControlFile1">Файл книги (разрешенные форматы:)</label>
                            <div style="display: block">Book File<i class="fas fa-pencil-alt"></i> </div>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <label for="exampleFormControlTextarea1">О книге</label>
                            <div style="display: block">Short Description<i class="fas fa-pencil-alt"></i> </div>
                            <textarea class="form-control" placeholder="Краткое описание" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>


                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                <button type="button" id="submit" name="submit" class="btn btn-primary">Добавить книгу</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
