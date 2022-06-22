<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
</head>

<body>

    <form method="POST" action="{{ route('message.update', $result->id) }}">
        @csrf
        @method('put')
        <input type="hidden" name="user_id" value="{{ $result->user_id }}" />
        Name： <input type="text" name="username" value="{{ $result->username }}" /><br>
        Title： <input type="text" name="title" value="{{ $result->title }}" /><br>
        Content： <br>
        <textarea rows="10" cols="28" name="content">{{ $result->content }}</textarea><br>
        Mood： <select name="mood_id">
            <option value="">--Choose a mood--</option>
            @foreach ($moods as $mood)
                <option value="{{ $mood->id }}" {{ $mood->id == $result->mood_id ? 'selected' : '' }}>
                    {{ $mood->mood }}</option>
            @endforeach
        </select>
        <input type="submit" value="Edit" />
    </form>

</body>

</html>
