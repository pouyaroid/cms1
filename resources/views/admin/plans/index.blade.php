<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت تعرفه‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">تعرفه‌ها</h3>
        <a href="{{ route('plans.create') }}" class="btn btn-success">افزودن تعرفه جدید</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
        </div>
    @endif

    @if($plans->count())
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>قیمت</th>
                        <th>دوره</th>
                        <th>محبوب</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->id }}</td>
                            <td>{{ $plan->title }}</td>
                            <td>{{ $plan->price ?? '-' }}</td>
                            <td>{{ $plan->period ?? '-' }}</td>
                            <td>{{ $plan->is_popular ? 'بله' : 'خیر' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-sm btn-warning">ویرایش</a>

                                    <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این تعرفه مطمئن هستید؟');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div class="alert alert-info">هیچ تعرفه‌ای ثبت نشده است.</div>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
