<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <title>@yield('title')</title>
</head>
<body>
    <div class="row">
        <div class="col-lg-8 mx-auto">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                    <a class="nav-link"href="{{route('recording.create')}}">Создать запись</a>
                    <a class="nav-link" href="{{route('recording.index')}}">Все записи</a>
                    <a class="nav-link" href="{{route('category.create')}}">Добавить Категорию</a>
                <form class="d-flex" action="{{route('search')}}">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{request('search')}}">
                <button class="btn btn-outline-warning" type="submit">Search</button>
                </form>
                <a class="btn btn-sm btn-outline-secondary"  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Sign up</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </div>
            </nav>
            @include('inc.message')
            <div class="mt-5">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
