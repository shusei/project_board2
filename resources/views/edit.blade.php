<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯</title>

    <style>
        span.red {
            color: red;
        }
    </style>
</head>

<body>
    <p><a href="{{ route('message.index') }}">回首頁</a></p>
    <form method="POST" action="{{ route('message.update', $result->id) }}" novalidate>
        @csrf
        @method('put')
        <input type="hidden" name="user_id" value="{{ $result->user_id }}">
        <span class="red">*</span>姓名： <input type="text" name="username" value="{{ $result->username }}" disabled><br>
        <span class="red">*</span>標題： <input type="text" name="title" value="{{ old('title') ?? $result->title }}" required><br>
        <span class="red">*</span>內容： <br>
        <textarea rows="10" cols="28" name="content" required>{{ old('content') ?? $result->content }}</textarea><br>
        心情： <select name="mood_id">
            <option value="">--請選擇一個心情--</option>
            @foreach ($moods as $mood)
                <option value="{{ $mood->id }}" {{ $mood->id == $result->mood_id ? 'selected' : '' }}>{{ $mood->mood }}</option>
            @endforeach
        </select>
        <input type="submit" value="Edit" />
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</body>

</html>
