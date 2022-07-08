@extends('layout.master')
@section('title', isset($user_id) ? "修改" : "註冊")
@section('content')

    <form method="POST" action="{{ isset($user->id) ? route('user.update', $user->id) : route('user.store') }}" novalidate>
        @csrf
        @if (isset($user->id))
            @method('put')
        @endif

        @if (!Auth::check())
            <span class="red">*</span>姓名： <input type="text" name="username" value="{{ $user->username ?? old('username') }}" required><br>
            <span class="red">*</span>Email： <input type="email" name="email" value="{{ $user->email ?? old('email') }}" required><br>
        @endif
        <span class="red">*</span>密碼： <input type="password" name="password" value="" required><br>
        <span class="red">*</span>確認密碼： <input type="password" name="password_confirmation" value="" required><br>

        <input type="submit" value={{ isset($user->id) ? "修改" : "註冊" }} >
    </form>

    {{-- <p>{{ session('error') ?? '' }}</p> --}}

    @if ($errors->any())
        <div class="red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
