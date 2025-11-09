@extends('layouts.app')
@section('title', 'مدیریت چرا ما')

@section('content')
<div class="container py-4" dir="rtl">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">مدیریت بخش "چرا ما"</h3>
        <a href="{{ route('admin.whyus.create') }}" class="btn btn-primary btn-sm">افزودن آیتم جدید</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>آیکون</th>
                        <th>عنوان</th>
                        <th>زیرعنوان</th>
                        <th>توضیحات</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($whyus as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><i class="{{ $item->icon }}"></i></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->subtitle }}</td>
                        <td>{{ Str::limit($item->description, 50) }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.whyus.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">ویرایش</a>
                                <form action="{{ route('admin.whyus.destroy', $item->id) }}" method="POST" onsubmit="return confirm('حذف شود؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4">هیچ آیتمی وجود ندارد.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
