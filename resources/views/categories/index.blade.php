@extends('layouts.app')

@section('content')
<div class="container">
    <h2>لیست دسته‌بندی‌ها</h2>

    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">افزودن دسته جدید</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>شناسه</th>
                <th>نام</th>
                <th>اسلاگ</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('حذف شود؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
@endsection
