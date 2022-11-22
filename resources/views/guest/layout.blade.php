<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Quotes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{asset('css/guest/app.css')}}" rel="stylesheet">
    <!-- CSS only -->
</head>
<body>
        <div class="topnav">
            <a href="/" class="active">Home</a>
            <a href="/top_directors" class="active">Top Directors</a>
            <a href="{{ route('login') }}" class="active">Log in</a>
        </div>

        <div class="guest">
            @yield('content')
        </div>


</body>
</html>
