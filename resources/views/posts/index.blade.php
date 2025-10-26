@extends('layouts.app')

@section('title', 'لیست پست‌ها')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📄 لیست پست‌ها</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-success fw-semibold">
            <i class="bi bi-plus-lg"></i> ایجاد پست جدید
        </a>
    </div>

    {{-- پیام موفقیت --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- جدول پست‌ها --}}
    <div class="table-responsive shadow-sm rounded-4 bg-white overflow-hidden">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="fw-semibold">عنوان</th>
                    <th class="fw-semibold">تصویر</th>
                    <th class="fw-semibold text-center">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}" class="img-thumbnail" style="width:80px; height:auto;">
                        @else
                            <span class="text-muted">بدون تصویر</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm me-1 mb-1">
                            <i class="bi bi-pencil-square"></i> ویرایش
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm mb-1" onclick="return confirm('آیا مطمئن هستید؟')">
                                <i class="bi bi-trash"></i> حذف
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- استایل‌های اضافه --}}
<style>
.table-hover tbody tr:hover {
    background-color: #f9f9f9;
    transition: 0.2s;
}
.btn-sm {
    font-size: 0.85rem;
    padding: 0.35rem 0.7rem;
}
.img-thumbnail {
    border-radius: 0.5rem;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}
</style>
@endsection
