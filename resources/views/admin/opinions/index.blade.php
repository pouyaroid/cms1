<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت نظرات کاربران</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">نظرات کاربران</h3>
        <a href="{{ route('admin.opinions.create') }}" class="btn btn-success">افزودن نظر جدید</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
        </div>
    @endif

    @if($opinions->count())
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width:70px">#</th>
                        <th>نام</th>
                        <th>سمت</th>
                        <th>نظر</th>
                        <th>آواتار</th>
                        <th>تاریخ</th>
                        <th style="width:180px">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($opinions as $opinion)
                        <tr>
                            <td>{{ $opinion->id }}</td>
                            <td>{{ $opinion->name }}</td>
                            <td>{{ $opinion->role ?? '-' }}</td>
                            <td class="text-start">{{ $opinion->comment }}</td>
                            <td>
                                @if($opinion->avatar)
                                    <img src="{{ asset('storage/' . $opinion->avatar) }}" alt="{{ $opinion->name }}" width="50" class="img-thumbnail">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $opinion->date ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.opinions.edit', $opinion->id) }}" class="btn btn-sm btn-warning">ویرایش</a>
                                    <form action="{{ route('admin.opinions.destroy', $opinion->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این نظر مطمئن هستید؟');" class="d-inline">
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
        <div class="alert alert-info">هیچ نظری ثبت نشده است.</div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
