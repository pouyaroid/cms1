<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن تعرفه</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3 class="mb-4">افزودن تعرفه جدید</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('plans.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">عنوان <span class="text-danger">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">زیرعنوان</label>
            <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">آیکون</label>
            <input type="text" name="icon" value="{{ old('icon') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">قیمت</label>
            <input type="text" name="price" value="{{ old('price') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">دوره</label>
            <input type="text" name="period" value="{{ old('period') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">متن دکمه</label>
            <input type="text" name="button_text" value="{{ old('button_text') }}" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_popular" value="1" class="form-check-input" id="is_popular">
            <label class="form-check-label" for="is_popular">محبوب</label>
        </div>

        <div class="mb-3">
            <label class="form-label">ویژگی‌ها</label>
            <input type="text" name="features[]" value="{{ old('features.0') }}" class="form-control mb-1" placeholder="ویژگی اول">
            <input type="text" name="features[]" value="{{ old('features.1') }}" class="form-control mb-1" placeholder="ویژگی دوم">
            <input type="text" name="features[]" value="{{ old('features.2') }}" class="form-control mb-1" placeholder="ویژگی سوم">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('plans.index') }}" class="btn btn-secondary">انصراف</a>
            <button type="submit" class="btn btn-success">ثبت تعرفه</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
