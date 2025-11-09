@extends('layouts.app')
@section('title', 'افزودن آیتم جدید - چرا ما')

@section('content')
<div class="container py-4" dir="rtl">
    <h3 class="mb-4">افزودن آیتم جدید</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.whyus.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">عنوان <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">زیرعنوان</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">آیکون (مثلاً fa-solid fa-star)</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">توضیحات</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.whyus.index') }}" class="btn btn-secondary">بازگشت</a>
            <button type="submit" class="btn btn-success">ثبت آیتم</button>
        </div>
    </form>
</div>
@endsection
