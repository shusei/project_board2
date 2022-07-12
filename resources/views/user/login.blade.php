@extends('layout.master')
@section('title', '登入')
@section('content')

    <form method="POST" action="{{ route('user.loginProcess') }}" novalidate>
        @csrf

        <div class="form-group">
            <span class="text-danger">*</span><label for="labelEmail">Email：</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <span class="text-danger">*</span><label for="labelPassword">密碼：</label>
            <input type="password" name="password" class="form-control" value="" required>
        </div>
        <div class="form-group d-flex flex-row-reverse">
            <input type="submit" class="btn btn-primary" value="登入">
        </div>
    </form>

    <p class="text-danger">{{ session('msg') ?? '' }}</p>

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
