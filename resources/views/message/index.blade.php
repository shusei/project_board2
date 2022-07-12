@extends('layout.master')
@section('title', '留言板')
@section('content')


    <div class="row justify-content-center">
        {{ $messages->links() }}
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">操作</th>
                <th scope="col">編號</th>
                <th scope="col">姓名</th>
                <th scope="col">內容</th>
                <th scope="col">建立時間</th>
                <th scope="col">更新時間</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($messages as $message)
                <tr>
                    <td>
                        @if ($message->user_id === Auth::id())
                            <br><button class="btn btn-info"
                                onclick="location.href='{{ route('message.edit', $message->id) }}'"
                                type="button">編輯</button>

                            <form action="{{ route('message.destroy', $message->id) }}" method="post">
                                @csrf
                                @method('delete')
                                {{-- 已在layout改用jQuery方式來寫Delete button --}}
                                <button class="btn btn-danger deleteMission" type="submit">删除</button>
                                {{-- <button class="btn btn-danger deleteMission" type="submit"
                                    onclick="return confirm('確認刪除？')">删除</button> --}}
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

    <div class="row justify-content-center">
        {{ $messages->links() }}
    </div>
@endsection
