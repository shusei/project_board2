@extends('layout.master')
@section('title', isset($message->id) ? '編輯' : '發表')
@section('content')

    <form method="POST" action="{{ isset($message->id) ? route('message.update', $message->id) : route('message.store') }}"
        novalidate>
        @csrf
        @if (isset($message->id))
            @method('put')
        @endif

        <div class="form-group">
            <span class="text-danger">*</span><label for="labelTitle">標題：</label>
            <input type="text" class="form-control" name="title" value="{{ $message->title ?? old('title') }}" required>
        </div>
        <div class="form-group">
            <span class="text-danger">*</span><label for="labelContent">內容：</label>
            <textarea rows="10" cols="28" class="form-control" name="content" required>{{ $message->content ?? old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label for="labelMood">心情：</label>
            <select name="mood_id" class="form-control">
                <option value="">--請選擇一個心情--</option>
                @foreach ($moods as $mood)
                    @if (isset($message->id))
                        <option value="{{ $mood->id }}"
                            {{ $mood->id == (old('mood_id') ?? $message->mood_id) ? 'selected' : '' }}>{{ $mood->mood }}
                        </option>
                    @else
                        <option value="{{ $mood->id }}" {{ $mood->id == old('mood_id') ? 'selected' : '' }}>
                            {{ $mood->mood }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <div class="text-right">
                <input type="submit" class="btn btn-primary" value={{ isset($message->id) ? '編輯' : '發表' }}>
            </div>
        </div>
    </form>

    @if ($errors->any())
        <div>
            <ul class="text-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
