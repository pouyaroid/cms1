@extends('layouts.app')

@section('title', 'ویرایش سوال متداول')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">ویرایش سوال</h3>

    <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">سوال</label>
            <input type="text" name="question" class="form-control"
                   value="{{ old('question', $faq->question) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">پاسخ</label>
            <textarea name="answer" class="form-control" rows="4" required>{{ old('answer', $faq->answer) }}</textarea>
        </div>

        <div class="text-end">
            <a href="{{ route('faqs.index') }}" class="btn btn-secondary">بازگشت</a>
            <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
        </div>

    </form>

</div>
@endsection
