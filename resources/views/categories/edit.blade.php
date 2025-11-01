@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ویرایش دسته</h2>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">نام دسته:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">بروزرسانی</button>
    </form>
</div>
@endsection
