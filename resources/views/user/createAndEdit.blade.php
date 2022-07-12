@extends('layout.master')
@section('title', isset($user_id) ? '修改' : '註冊')
@section('content')

    <form method="POST" action="{{ isset($user->id) ? route('user.update', $user->id) : route('user.store') }}" novalidate>
        @csrf
        @if (isset($user->id))
            @method('put')
        @endif

        @if (!Auth::check())
            <div class="form-group">
                <span class="text-danger">*</span><label for="labelName">姓名：</label>
                <input type="text" name="username" class="form-control" value="{{ $user->username ?? old('username') }}"
                    required>
            </div>
            <div class="form-group">
                <span class="text-danger">*</span><label for="labelEmail">Email：</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email ?? old('email') }}"
                    required>
            </div>
        @endif
        <div class="form-group">
            <span class="text-danger">*</span><label for="labelPassword">密碼：</label>
            <input type="password" name="password" class="form-control" value="" required>
        </div>
        <div class="form-group">
            <span class="text-danger">*</span><label for="labelPasswordConfirm">確認密碼：</label>
            <input type="password" class="form-control" name="password_confirmation" value="" required>
        </div>
        <div class="form-group d-flex flex-row-reverse">
            <input type="submit" class="btn btn-primary" value={{ isset($user->id) ? '修改' : '註冊' }}>
        </div>
    </form>

    {{-- <p>{{ session('error') ?? '' }}</p> --}}

    @if ($errors->any())
        <div class="row justify-content-center">
            <ul class="text-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
