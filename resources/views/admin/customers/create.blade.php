@extends('layouts.app')

@section('title', 'افزودن مشتری')

@section('content')
<div class="container py-4" dir="rtl">
    <h3 class="mb-4">افزودن مشتری جدید</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- enctype برای آپلود فایل الزامی است -->
    <form action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">نام مشتری</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">لوگو مشتری <span class="text-danger">*</span></label>
            <input type="file" name="logo_file" class="form-control" required>
            <div class="form-text">یک فایل تصویر انتخاب کنید.</div>
        </div>

        <div class="mb-3">
            <label class="form-label">آدرس وبسایت</label>
            <input type="url" name="website_url" value="{{ old('website_url') }}" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">انصراف</a>
            <button type="submit" class="btn btn-success">ثبت مشتری</button>
        </div>
    </form>
</div>
@endsection
