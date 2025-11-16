<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت نمونه‌کارها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>نمونه‌کارها</h3>
        <a href="{{ route('portfolio.create') }}" class="btn btn-success">افزودن نمونه‌کار جدید</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($portfolios->count())
    <table class="table table-hover align-middle text-center">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>عنوان</th>
                <th>دسته‌بندی</th>
                <th>لینک</th>
                <th>تصویر</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($portfolios as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->category }}</td>
                <td>
                    @if($item->link)
                        <a href="{{ $item->link }}" target="_blank">مشاهده</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" width="80" class="img-thumbnail">
                    @else
                        ندارد
                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('portfolio.edit', $item->id) }}" class="btn btn-warning btn-sm">ویرایش</a>

                        <form action="{{ route('portfolio.destroy', $item->id) }}" method="POST" onsubmit="return confirm('آیا حذف شود؟');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $portfolios->links() }}
    @else
        <div class="alert alert-info">هیچ نمونه‌کاری ثبت نشده است.</div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
