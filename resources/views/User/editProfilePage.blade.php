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
                                        <input type="file"  name="path_to_avatar">
                                        <button class="btn btn-primary fa fa-cloud-upload" >Обновить аватар</button>
                                    </form>
                                    <form action="/deleteavatar" method="post" enctype="multipart/form-data">
                                        <button class="btn btn-danger fa fa-trash-alt" >Удалить</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                                <span class="text-secondary">@bootdey</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div >
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
                                        <a onclick="editProfile()"><i class="fas fa-check"></i>Сохранить изменения</a>
                                        <a onclick="hideEditName()"><i class="fas fa-times"></i>Отменить</a>
                                    </div>
                                    <div id="showName" style="display: block">{{$user->name}}<a onclick="showEditName()"><i class="fas fa-pencil-alt"></i> Редактировать</a> </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div id="changeEmail" style="display: none"  class="col-sm-9 text-secondary">
                                        <input type="text" id="email" placeholder="{{$user->email}}"><br>
                                        <a onclick="editProfile()">  <i class="fas fa-check"></i> Сохранить изменения</a>
                                        <a onclick="hideEditEmail()"><i class="fas fa-times"></i>Отменить</a>
                                    </div>
                                        <div id="showEmail" style="display: block">{{$user->email}}<a onclick="showEditEmail()"><i class="fas fa-pencil-alt"></i> Редактировать</a> </div>
                                    </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div id="changePassword" style="display: none" class="col-sm-9 text-secondary">
                                        <input type="password" id="password"><br>
                                        <a  onclick="editProfile()"><i class="fas fa-check"></i>   Сохранить изменения</a>
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
