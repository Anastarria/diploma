@extends('layout')

@section('content')
    <div class="container">
        <h3>Sign in</h3>
        <div id="loader" style="display: none">Processing...</div>

        <div id="success" class="alert alert-success" role="alert" style="display:none">Login successful. Redirecting...</div>

        <div id="main">
            <div class="alert alert-warning" role="alert" id="error" style="display: none">
                An error occurred
            </div>
            <input class="form-control" type="email" id="email" placeholder="example@domain.com">
            <input class="form-control" type="password" id="password" placeholder="Your password here">
            <button type="submit" class="btn btn-success" onclick="login()">Sign in</button>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/auth.js') }}" ></script>
    @endpush
@endsection

