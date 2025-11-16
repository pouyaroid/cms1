@extends('layouts.app')

@section('title', 'ویرایش مشتری')

@section('content')
<div class="container py-4" dir="rtl">
    <h3 class="mb-4">ویرایش مشتری</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">نام مشتری</label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">آدرس لوگو <span class="text-danger">*</span></label>
            <input type="text" name="logo_path" value="{{ old('logo_path', $customer->logo_path) }}" class="form-control" required>
            @if($customer->logo_path)
                <div class="mt-2">
                    <img src="{{ asset($customer->logo_path) }}" width="120" class="img-thumbnail" alt="logo">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">آدرس وبسایت</label>
            <input type="url" name="website_url" value="{{ old('website_url', $customer->website_url) }}" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">بازگشت</a>
            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
        </div>
    </form>
</div>
@endsection
