<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن نمونه‌کار</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3>افزودن نمونه‌کار جدید</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>عنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label>دسته‌بندی (می‌توانید دسته‌بندی دلخواه وارد کنید)</label>
            <input type="text" name="category" class="form-control" value="{{ old('category') }}" placeholder="مثال: وب، موبایل، اپلیکیشن" required>
        </div>

        <div class="mb-3">
            <label>لینک</label>
            <input type="url" name="link" class="form-control" value="{{ old('link') }}">
        </div>

        <div class="mb-3">
            <label>تصویر <span class="text-danger">*</span></label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">انصراف</a>
            <button type="submit" class="btn btn-success">ثبت نمونه‌کار</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
