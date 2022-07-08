@extends('layout.master')
@section('title', isset($message->id) ? "編輯" : "發表")
@section('content')

    <form method="POST" action="{{ isset($message->id) ? route('message.update', $message->id) : route('message.store') }}" novalidate>
        @csrf
        @if (isset($message->id))
            @method('put')
        @endif

        <span class="red">*</span>標題： <input type="text" name="title" value="{{ $message->title ?? old('title') }}" required><br>
        <span class="red">*</span>內容： <br>
        <textarea rows="10" cols="28" name="content" required>{{ $message->content ?? old('content') }}</textarea><br>
        心情： <select name="mood_id">
            <option value="">--請選擇一個心情--</option>
            @foreach ($moods as $mood)
                @if (isset($message->id))
                    <option value="{{ $mood->id }}" {{ $mood->id == (old('mood_id') ?? $message->mood_id) ? 'selected' : '' }}>{{ $mood->mood }}</option>
                @else
                    <option value="{{ $mood->id }}" {{ $mood->id == old('mood_id') ? 'selected' : '' }}>{{ $mood->mood }}</option>
                @endif
            @endforeach
        </select>
        <input type="submit" value={{ isset($message->id) ? "編輯" : "發表" }} >
    </form>

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
