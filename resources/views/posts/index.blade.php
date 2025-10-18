@extends('layouts.app')

@section('content')
<div class="container">
    <h2>لیست پست‌ها</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">ایجاد پست جدید</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>عنوان</th>
            <th>تصویر</th>
            <th>عملیات</th>
        </tr>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" width="100">
                @endif
            </td>
            <td>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">ویرایش</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $posts->links() }}
</div>
@endsection
