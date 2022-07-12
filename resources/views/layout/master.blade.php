<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0", shrink-to-fit=no>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="/assets/css/index.css" rel="stylesheet" type="text/css"> --}}
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("button.deleteMission").click(function() {
                return confirm('確認刪除？');
            });
        });
    </script>
</head>

<body>
    <header>
        <div class="container-fluid bg-light">
            <div class="row justify-content-center">
                <h1 class="display-1">我是留言板</h1>
            </div>
            <div class="text-center">
                @if (null !== session('msg'))
                    <div class="col-auto">
                        <h1 class="alert alert-success" role="alert">{{ session('msg') }}</h1>
                    </div>
                @endif
            </div>
            <div class="row justify-content-between">
                <div class="col-6">
                    <form method="get" action="{{ route('search') }}" novalidate>
                        <label for="labelSearch">搜尋列：</label>
                        <input type="text" name="q" value="" required>
                        <input type="submit" class="btn btn-primary" value="搜尋">
                    </form>
                </div>
                <div class="col-6 d-flex flex-row-reverse">
                    @if (Auth::check())
                        登入中的使用者：{{ Auth::user()->username }}
                    @endif
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-6">
                    <a href="{{ route('homepage') }}" class="btn btn-primary">回首頁</a>
                </div>
                <div class="col-auto mx-0">
                    @if (Auth::check())
                        <button class="btn btn-success" onclick="location.href='{{ route('message.create') }}'"
                            type="button">發表留言</button>
                        <button class="btn btn-success" onclick="location.href='{{ route('user.edit', Auth::id()) }}'"
                            type="button">修改密碼</button>
                        <button class="btn btn-danger" onclick="location.href='{{ route('user.logout') }}'"
                            type="button">登出</button>
                    @else
                        <button class="btn btn-primary" onclick="location.href='{{ route('user.create') }}'"
                            type="button">註冊</button>
                        <button class="btn btn-primary" onclick="location.href='{{ route('user.login') }}'"
                            type="button">登入</button>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        @yield('content')
    </div>


    <footer>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <p>Copyright © 2022 Center97 All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
</body>

</html>
