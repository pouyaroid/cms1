<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت مشتریان</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">مشتریان</h3>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-success">افزودن مشتری جدید</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
        </div>
    @endif

    @if($customers->count())
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width:70px">#</th>
                        <th class="text-start">نام</th>
                        <th>لوگو</th>
                        <th>وبسایت</th>
                        <th style="width:180px">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td class="text-start">{{ $customer->name ?? '-' }}</td>
                            <td>
                                @if($customer->logo_path)
                                    <img src="{{ asset('storage/'.$customer->logo_path) }}" alt="{{ $customer->name }}" width="80" class="img-thumbnail">
                                @else
                                    <span class="text-muted">ندارد</span>
                                @endif
                            </td>
                            <td>
                                @if($customer->website_url)
                                    <a href="{{ $customer->website_url }}" target="_blank">مشاهده</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">ویرایش</a>

                                    <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این مشتری مطمئن هستید؟');" class="d-inline">
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
        <div class="alert alert-info">هیچ مشتری‌ای ثبت نشده است.</div>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
