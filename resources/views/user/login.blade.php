@extends('layout.master')
@section('title', '登入')
@section('content')

    <form method="POST" action="{{ route('user.loginProcess') }}" novalidate>
        @csrf

        <span class="red">*</span>Email： <input type="email" name="email" value="{{ old('email') }}" required><br>
        <span class="red">*</span>密碼： <input type="password" name="password" value="" required><br>

        <input type="submit" value="登入" >
    </form>

    <p class="red">{{ session('msg') ?? '' }}</p>

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
