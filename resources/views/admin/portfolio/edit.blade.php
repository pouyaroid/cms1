<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش نمونه‌کار</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3>ویرایش نمونه‌کار</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>عنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required>
        </div>

        <div class="mb-3">
            <label>دسته‌بندی</label>
            <select name="category" class="form-select" required>
                <option value="web" {{ (old('category', $portfolio->category)=='web')?'selected':'' }}>وب</option>
                <option value="mobile" {{ (old('category', $portfolio->category)=='mobile')?'selected':'' }}>موبایل</option>
                <option value="app" {{ (old('category', $portfolio->category)=='app')?'selected':'' }}>اپلیکیشن</option>
            </select>
        </div>

        <div class="mb-3">
            <label>لینک</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $portfolio->link) }}">
        </div>

        <div class="mb-3">
            <label>تصویر</label>
            <input type="file" name="image" class="form-control">
            @if($portfolio->image)
                <img src="{{ asset('storage/'.$portfolio->image) }}" width="100" class="img-thumbnail mt-2">
            @endif
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">انصراف</a>
            <button type="submit" class="btn btn-success">به‌روزرسانی</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
