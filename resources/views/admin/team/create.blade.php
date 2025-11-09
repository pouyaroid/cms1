@extends('layouts.app')

@section('title', 'مدیریت اعضای تیم')

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
        {{-- فرم افزودن عضو جدید --}}
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    افزودن عضو جدید
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

                    <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label class="form-label">تصویر (jpg,jpeg,png)</label>
                            <input type="file" name="image" accept="image/*" class="form-control">
                        </div>

                        <div class="d-flex justify-content-between">
                        
                            <button type="submit" class="btn btn-success">افزودن عضو</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- لیست اعضا + عملیات ویرایش/حذف --}}
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span>لیست اعضای تیم</span>
                    <small class="text-muted">{{ $teamMembers->count() }} عضو</small>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px">#</th>
                                <th>تصویر</th>
                                <th>نام</th>
                                <th>سمت</th>
                                <th style="width:170px">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teamMembers as $member)
                                <tr>
                                    <td>{{ $member->id }}</td>
                                    <td>
                                        @if($member->image)
                                            <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" width="70" class="rounded">
                                        @else
                                            <span class="text-muted">ندارد</span>
                                        @endif
                                    </td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->role ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- دکمه باز کردن مودال ویرایش --}}
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $member->id }}">
                                                ویرایش
                                            </button>

                                            {{-- حذف --}}
                                            <form action="{{ route('team.destroy', $member->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این عضو اطمینان دارید؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- مودال ویرایش برای هر عضو --}}
                                <div class="modal fade" id="editModal{{ $member->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $member->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $member->id }}">ویرایش: {{ $member->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label class="form-label">نام <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">سمت</label>
                                                        <input type="text" name="role" class="form-control" value="{{ old('role', $member->role) }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">تصویر جدید (در صورت نیاز)</label>
                                                        <input type="file" name="image" accept="image/*" class="form-control">
                                                        @if($member->image)
                                                            <div class="mt-2">
                                                                <small class="text-muted">تصویر فعلی:</small>
                                                                <br>
                                                                <img src="{{ asset('storage/' . $member->image) }}" width="90" class="rounded mt-1" alt="current">
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
                                    <td colspan="5" class="py-4 text-muted">هیچ عضوی ثبت نشده است.</td>
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
