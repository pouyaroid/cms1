@extends('layouts.app')

@section('title', 'مدیریت محصولات')

@section('content')
<div class="container py-4" dir="rtl">

    {{-- پیام موفقیت --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- فرم افزودن محصول جدید --}}
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    افزودن محصول جدید
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">عنوان محصول <span class="text-danger">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">توضیحات</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">قیمت</label>
                            <input type="text" name="price" value="{{ old('price') }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">لینک خرید (اختیاری)</label>
                            <input type="url" name="link" value="{{ old('link') }}" class="form-control" placeholder="https://example.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">تصویر محصول</label>
                            <input type="file" name="image" accept="image/*" class="form-control">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">افزودن محصول</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- لیست محصولات --}}
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span>لیست محصولات</span>
                    <small class="text-light">{{ $products->count() }} عدد</small>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>تصویر</th>
                                <th>عنوان</th>
                                <th>قیمت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/'.$product->image) }}" width="60" class="rounded">
                                        @else
                                            <span class="text-muted">ندارد</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->price ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- ویرایش --}}
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                                ویرایش
                                            </button>

                                            {{-- حذف --}}
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این محصول اطمینان دارید؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- مودال ویرایش محصول --}}
                                <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $product->id }}">ویرایش محصول: {{ $product->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label class="form-label">عنوان</label>
                                                        <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">توضیحات</label>
                                                        <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">قیمت</label>
                                                        <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">لینک خرید</label>
                                                        <input type="url" name="link" class="form-control" value="{{ old('link', $product->link) }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">تصویر جدید (اختیاری)</label>
                                                        <input type="file" name="image" accept="image/*" class="form-control">
                                                        @if($product->image)
                                                            <div class="mt-2">
                                                                <small class="text-muted">تصویر فعلی:</small><br>
                                                                <img src="{{ asset('storage/'.$product->image) }}" width="80" class="rounded mt-1">
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                                                        <button type="submit" class="btn btn-primary">ذخیره</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-muted">هیچ محصولی ثبت نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
