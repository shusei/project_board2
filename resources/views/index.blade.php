<html>

<head>
    <title>留言板</title>
</head>

<body>
    <form method="POST" action="{{ route('message.store') }}">
        @csrf
        Name： <input type="text" name="user_id" /><br>
        Title： <input type="text" name="title" /><br>
        Content： <br>
        <textarea rows="10" cols="28" name="content"></textarea><br>
        Mood： <select name="mood_id">
            <option value="">--請選擇一個心情--</option>
            @foreach ($moods as $mood)
                <option value="{{ $mood->id }}">{{ $mood->mood }}</option>
            @endforeach
        </select>
        <input type="submit" value="留言" />
    </form>

    @foreach ($results as $result)
        <br>No. {{ $result->id }}
        <br>Name： {{ $result->username }}
        <br>Title： {{ $result->title }}
        <br>Content：<br>
        <pre>{{ $result->content }} </pre>
        <br>Mood： {{ $result->mood }}
        <br>Created Time： {{ $result->created_at }}
        <br>Updated Time： {{ $result->updated_at }}

        {{-- <button type="submit" onclick="return confirm('確認編輯？')">編輯</button> --}}
        <br><button onclick="location.href='{{ route('message.edit', $result->id) }}'" type="button">編輯</button>

        <form action="{{ route('message.destroy', $result->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('確認刪除？')">删除</button>
        </form>-------------------------------------------------------<br>
    @endforeach
</body>

</html>
