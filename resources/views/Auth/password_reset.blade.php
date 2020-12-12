@extends('layout')

@section('content')
    <div class="container">
        <h3>Восстановление пароля</h3>
        <p style="color: #24364b">Укажите свой контактный адрес электронной почты. </p>
        <div id="loader" style="display: none">Обработка запроса...</div>

        <div id="success" class="alert alert-success" role="alert" style="display:none">Login successful. Redirecting...</div>

        <div id="main">
            <div class="alert alert-warning" role="alert" id="error" style="display: none">
                An error occurred
            </div>

            <input class="form-control" type="email" id="email" placeholder="example@domain.com"><br>

            <button type="submit" class="btn btn-success" onclick="resetPassword()">Отправить мне ссылку для восстановления пароля. </button>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/auth.js') }}" ></script>
    @endpush
@endsection

