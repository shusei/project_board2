<html>

<head>
    <link href="/assets/css/index.css" rel="stylesheet" type="text/css">
    <title>留言板</title>
</head>

<body>
    <h1>我是留言板</h1>

    <p><br>狀態列：{{ session('msg') ?? '' }}</p>

    <br><button class="button-style" onclick="location.href='{{ route('message.create') }}'" type="button">發表留言</button>

    <table>
        <thead>
            <tr>
                <th>操作</th>
                <th>樓層</th>
                <th>姓名</th>
                <th>內容</th>
                <th>建立時間</th>
                <th>更新時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>
                        <br><button class="button-style"
                            onclick="location.href='{{ route('message.edit', $result->id) }}'"
                            type="button">編輯</button>

                        <form action="{{ route('message.destroy', $result->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="button-style" type="submit" onclick="return confirm('確認刪除？')">删除</button>
                        </form>
                    </td>
                    <td>
                        {{ $result->id }} 樓
                    </td>
                    <td>
                        {{ $result->username }}
                    </td>
                    <td class="content">
                        標題： {{ $result->title }}<br>
                        內容：<br>
                        <pre>{{ $result->content }} </pre>
                        @if (!empty($result->mood))
                            <br>心情： {{ $result->mood }}
                        @endif
                    </td>
                    <td>
                        {{ $result->created_at }}
                    </td>
                    <td>
                        {{ $result->updated_at }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
