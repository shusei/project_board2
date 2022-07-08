@extends('layout.master')
@section('title', '留言板')
@section('content')

    <table>
        <thead>
            <tr>
                <th>操作</th>
                <th>編號</th>
                <th>姓名</th>
                <th>內容</th>
                <th>建立時間</th>
                <th>更新時間</th>
            </tr>
        </thead>
        <tbody>
            {{ $messages->links() }}

            @foreach ($messages as $message)
                <tr>
                    <td>
                        @if ($message->user_id === Auth::id())
                            <br><button class="button-style" onclick="location.href='{{ route('message.edit', $message->id) }}'" type="button">編輯</button>

                            <form action="{{ route('message.destroy', $message->id) }}" method="post">
                                @csrf
                                @method('delete')
                                {{-- //TODO:jQuery --}}
                                <button class="button-style" type="submit" onclick="return confirm('確認刪除？')">删除</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        {{ $message->id }}
                    </td>
                    <td>
                        {{ $message->username }}
                    </td>
                    <td class="content">
                        標題： {{ $message->title }}<br>
                        內容：<br>
                        <pre>{{ $message->content }} </pre>
                        @if (!empty($message->mood))
                            <br>心情： {{ $message->mood }}
                        @endif
                    </td>
                    <td>
                        {{ $message->created_at }}
                    </td>
                    <td>
                        {{ $message->updated_at }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $messages->links() }}
@endsection
