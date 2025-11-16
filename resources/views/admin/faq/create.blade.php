@extends('layouts.app')

@section('title', 'افزودن سوال متداول')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">افزودن سوال جدید</h3>

    <form action="{{ route('faqs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">سوال</label>
            <input type="text" name="question" class="form-control" value="{{ old('question') }}" required>
            @error('question') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">پاسخ</label>
            <textarea name="answer" class="form-control" rows="4" required>{{ old('answer') }}</textarea>
            @error('answer') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="text-end">
            <a href="{{ route('faqs.index') }}" class="btn btn-secondary">انصراف</a>
            <button type="submit" class="btn btn-success">ثبت سوال</button>
        </div>

    </form>

</div>
@endsection
