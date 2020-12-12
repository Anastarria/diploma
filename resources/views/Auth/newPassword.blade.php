@extends('layout')

@section('content')
    <div class="container">
        <h3>Восстановление пароля</h3>
        <p style="color: #24364b">Укажите новый пароль:</p>
        <div id="loader" style="display: none">Обработка запроса...</div>

        <div id="main">
            <div class="alert alert-warning" role="alert" id="error" style="display: none">
                An error occurred
            </div>
            <input class="form-control" type="hidden" id="email" name="email" value="{{$user_email}}"><br>
            <input class="form-control" type="password" id="password"><br>

            <button type="submit" class="btn btn-success" onclick="resetConfirmation()">Изменить пароль. </button>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/auth.js') }}" ></script>
    @endpush
@endsection

