<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/assets/css/index.css" rel="stylesheet" type="text/css">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <style>
        div.red, span.red {
            color: red;
        }
    </style>

</head>

<body>
    <header>
        <h1>我是留言板</h1>

        <br>狀態列：{{ session('msg') ?? '' }}

        @if (Auth::check())
            <div style="text-align: right">登入中的使用者：{{  Auth::user()->username  }}</div><br>
        @endif

        <form method="get" action="{{ route('search') }}" novalidate>
            <br>搜尋列： <input type="text" name="q" value="" required>
            <input type="submit" value="搜尋" >
        </form>

        @if (Auth::check())
            <button class="button-style" onclick="location.href='{{ route('message.create') }}'" type="button">發表留言</button>
            <button class="button-style" onclick="location.href='{{ route('user.edit', Auth::id()) }}'" type="button">修改密碼</button>
            <button class="button-style" onclick="location.href='{{ route('user.logout') }}'" type="button">登出</button>
        @else
            <button class="button-style" onclick="location.href='{{ route('user.create') }}'" type="button">註冊</button>
            <button class="button-style" onclick="location.href='{{ route('user.login') }}'" type="button">登入</button>
        @endif
        <br><p><a href="{{ route('homepage') }}">回首頁</a></p>
    </header>

    <div>
        @yield('content')
    </div>


    <footer>
        <div style="text-align: center">
            <p>Copyright © 2022 Center97 All Rights Reserved.</p>
        </div>
    </footer>

</body>

</html>
