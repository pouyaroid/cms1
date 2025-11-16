<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن نظر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3 class="mb-4">افزودن نظر جدید</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.opinions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">نام <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">سمت</label>
            <input type="text" name="role" value="{{ old('role') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">نظر <span class="text-danger">*</span></label>
            <textarea name="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">آواتار</label>
            <input type="file" name="avatar" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">تاریخ</label>
            <input type="date" name="date" value="{{ old('date') }}" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.opinions.index') }}" class="btn btn-secondary">انصراف</a>
            <button type="submit" class="btn btn-success">ثبت نظر</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
