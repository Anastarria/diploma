@extends('layout')
@section('content')
    <div class="container">
              <h3>Create an account</h3>
            <div id="loader" style="display: none">Processing...</div>

            <div id="success" class="alert alert-success" role="alert" style="display:none">Registration successful. Redirecting...</div>

            <div id="main">
                @csrf
                    <div class="alert alert-warning" role="alert" id="error" style="display: none">
                        An error occurred
                    </div>
                    <input class="form-control" type="email" id="email" placeholder="example@domain.com">
                    <input class="form-control" type="text" id="name" placeholder="Your Name Here">
                    <input class="form-control" type="text" id="nickname" placeholder="Choose your username">
                    <input class="form-control" type="password" id="password" placeholder="Your password here">
                    <button type="submit" class="btn btn-success" onclick="registering()">Sign up</button>
                    <div>
                        Already have an account? <a href="/login">Sign in!</a>
                    </div>
            </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset("js/auth.js") }}"></script>
@endpush
