@extends('admin.layouts.app')

@section('title', 'مدیریت هیرو بنرها')

@section('content')
<div class="container mt-5">

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>لیست هیرو بنرها</h4>
        <a href="{{ route('admin.hero.create') }}" class="btn btn-primary">افزودن بنر جدید</a>
    </div>

    @if($heroes->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>عنوان</th>
                        <th>زیرعنوان</th>
                        <th>تصویر اصلی</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($heroes as $hero)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $hero->title ?: '—' }}</td>
                            <td>{{ $hero->subtitle ?: '—' }}</td>
                            <td>
                                @if($hero->main_image)
                                    <img src="{{ asset('storage/'.$hero->main_image) }}" style="height:60px;">
                                @else
                                    <span class="text-muted">ندارد</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.hero.edit', $hero->id) }}" class="btn btn-sm btn-warning">ویرایش</a>
                                <form action="{{ route('admin.hero.destroy', $hero->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('آیا مطمئنی؟')" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center text-muted py-5">
            <p>هیچ بنری وجود ندارد.</p>
            <a href="{{ route('admin.hero.create') }}" class="btn btn-outline-primary">افزودن اولین بنر</a>
        </div>
    @endif
</div>
@endsection
