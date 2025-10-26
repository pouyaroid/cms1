@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>ویرایش منو</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">عنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $menu->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">لینک (Slug)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $menu->slug) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">زیرمنو</label>
            <select name="parent_id" class="form-select">
                <option value="">ندارد</option>
                @foreach($parents ?? [] as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
                        {{ $parent->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">ترتیب</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $menu->order) }}">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_external" value="1" {{ old('is_external', $menu->is_external) ? 'checked' : '' }}>
            <label class="form-check-label">لینک خارجی</label>
        </div>

        <button type="submit" class="btn btn-primary">بروزرسانی</button>
        <a href="{{ route('menus.index') }}" class="btn btn-secondary">بازگشت</a>
    </form>
</div>
@endsection
