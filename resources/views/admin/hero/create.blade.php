@extends('layouts.app')

@section('title', 'افزودن بنر جدید')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">افزودن بنر جدید</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">عنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">زیرعنوان</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">توضیحات</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">متن هایلایت</label>
            <input type="text" name="highlight_text" class="form-control" value="{{ old('highlight_text') }}">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">متن دکمه اصلی</label>
                <input type="text" name="primary_button_text" class="form-control" value="{{ old('primary_button_text') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">لینک دکمه اصلی</label>
                <input type="text" name="primary_button_link" class="form-control" value="{{ old('primary_button_link') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">متن دکمه ثانویه</label>
                <input type="text" name="secondary_button_text" class="form-control" value="{{ old('secondary_button_text') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">لینک دکمه ثانویه</label>
                <input type="text" name="secondary_button_link" class="form-control" value="{{ old('secondary_button_link') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">تصویر اصلی</label>
            <input type="file" name="main_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">تصویر شکل</label>
            <input type="file" name="shape_image" class="form-control" accept="image/*">
        </div>

        <div class="text-end">
            <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">انصراف</a>
            <button type="submit" class="btn btn-success">افزودن بنر</button>
        </div>
    </form>
</div>
@endsection
