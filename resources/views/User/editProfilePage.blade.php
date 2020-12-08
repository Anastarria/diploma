@extends('layout')
@section('content')
    <div class="container"><h3>Edit Profile Details</h3> <a href="/profile/info" ><i class="fas fa-times"></i>  [Вернуться в профиль]</a> </div>
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
                                    <h4>Настройки аватара</h4>
                                    <form action="/editavatar" method="post" enctype="multipart/form-data">
                                        <input type="file" accept="image/jpeg,image/png"  name="path_to_avatar" required>
                                        <button class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Обновить аватар</button>
                                    </form>
                                    <form action="/deleteavatar" method="post" enctype="multipart/form-data">
                                        <button class="btn btn-danger" ><i class="far fa-trash-alt"></i> Удалить</button>
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
                                        <input type="text" id="name" placeholder="{{$user->name}}"><br>
                                        <a onclick="editProfileName()"><i class="fas fa-check"></i>Сохранить изменения</a>
                                        <a onclick="hideEditName()"><i class="fas fa-times"></i>Отменить</a>
                                    </div>
                                    <div id="showName" style="display: block">{{$user->name}}<a onclick="showEditName()"><i class="fas fa-pencil-alt"></i> Редактировать</a> </div>
                                    </div>
                                </div>
                                <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div id="changePassword" style="display: none" class="col-sm-9 text-secondary">
                                        <input type="password" id="password"><br>
                                        <a  onclick="editProfilePassword()"><i class="fas fa-check"></i>   Сохранить изменения</a>
                                        <a onclick="hideEditPassword()"><i class="fas fa-times"></i>Отменить</a>
                                    </div>
                                    <div id="showHiddenPassword" style="display: block">******<a onclick="showEditPassword()"><i class="fas fa-pencil-alt"></i> Редактировать</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/editprofile.js') }}" ></script>
    @endpush
@endsection
