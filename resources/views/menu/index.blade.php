@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>مدیریت منوها</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('menus.create') }}" class="btn btn-success mb-3">ایجاد منوی جدید</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>عنوان</th>
                <th>لینک (Slug)</th>
                <th>ترتیب</th>
                <th>زیرمنوها</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
                <tr>
                    <td>{{ $menu->title }}</td>
                    <td>{{ $menu->slug }}</td>
                    <td>{{ $menu->order }}</td>
                    <td>
                        @foreach($menu->children as $child)
                            <span class="badge bg-primary">{{ $child->title }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-warning">ویرایش</a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">هیچ منویی موجود نیست</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
