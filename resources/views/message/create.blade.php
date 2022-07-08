<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>發表留言</title>

    <style>
        div, span.red {
            color: red;
        }
    </style>

</head>

<body>
    <p><a href="{{ route('homepage') }}">回首頁</a></p>
    <form method="POST" action="{{ route('message.store') }}" novalidate>
        @csrf
        <span class="red">*</span>User ID： <input type="text" name="user_id" placeholder="User ID" value="{{ old('user_id') }}" required><br>
        <span class="red">*</span>標題： <input type="text" name="title" placeholder="標題" value="{{ old('title') }}" required><br>
        <span class="red">*</span>內容： <br>
        <textarea rows="10" cols="28" name="content" placeholder="內容"  required>{{ old('content') }}</textarea><br>
        心情： <select name="mood_id">
            <option value="">--請選擇一個心情--</option>
            @foreach ($moods as $mood)
                <option value="{{ $mood->id }}" {{ $mood->id == old('mood_id') ? 'selected' : '' }}>{{ $mood->mood }}</option>
            @endforeach
        </select>
        <input type="submit" value="留言">
    </form>

    @if ($errors->any())
        <div class="red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</body>

</html>
