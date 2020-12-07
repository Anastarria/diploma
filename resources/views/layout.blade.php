<html>
<head>

    @stack('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset("css/profile.css") }}">
    <link rel="stylesheet" href="{{asset("css/notifications.css")}}">
    <script src="{{asset("js/notifications.js")}}"></script>

</head>
<body>
@section('navbar')
<nav class="navbar read-nav navbar-default">
    <div class="container-fluid read-nav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Take Some Time To Read</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav justify-content-center">

                @if (!$user = \Illuminate\Support\Facades\Auth::user())
                <li><a href="/support">Support</a></li>
                <li><a href="/login">Sign In</a></li>
                <li><a href="/register">Sign Up</a></li>
                @endif


                @if($user = \Illuminate\Support\Facades\Auth::user())
                <li><a href="/support">Support</a></li>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hello, {{$user->nickname}}! <i class="fas fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item btn" href="/profile/info">Profile</a><br>
                            @if($user->is_admin == 1)
                            <a class="dropdown-item btn" href="/profile/info">Create a new book</a><br>
                            @endif
                            <a class="dropdown-item btn" href="/logout">Sign Out</a><br>
                        </div>
                </li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><input class="form-control" type="search" placeholder="Search" aria-label="Search"></li>
                <li><a href="/">Поиск</a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

@endsection
@yield('navbar')
@yield('content')

</body>

</html>
