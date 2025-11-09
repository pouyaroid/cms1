@extends('layouts.app')

@section('title', 'پیام های تماس')

@section('content')
<div class="container-fluid py-4" dir="rtl">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">پیام های ارسال شده</h3>
        <form class="row g-2" method="GET" action="{{ route('admin.contact.index') }}">
            <div class="col-auto">
                <input type="search" name="q" value="{{ old('q', $q ?? '') }}" class="form-control form-control-sm" placeholder="جستجو در نام، ایمیل یا پیام">
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-primary" type="submit">جستجو</button>
            </div>
        </form>
    </div>

    {{-- پیام موفقیت --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width:70px;">#</th>
                            <th scope="col">نام و نام خانوادگی</th>
                            <th scope="col">ایمیل</th>
                            <th scope="col">متن کوتاه پیام</th>
                            <th scope="col">تاریخ</th>
                            <th scope="col" style="width:180px;">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                        <tr>
                            <td>{{ $message->id }}</td>
                            <td>{{ $message->fullname }}</td>
                            <td>{{ $message->email ?? '—' }}</td>
                            <td>
                                @php
                                    $short = \Illuminate\Support\Str::limit(strip_tags($message->comment), 60);
                                @endphp
                                {{ $short }}
                            </td>
                            <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button
                                        class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewMessageModal"
                                        data-id="{{ $message->id }}"
                                        data-fullname="{{ e($message->fullname) }}"
                                        data-email="{{ e($message->email) }}"
                                        data-comment="{{ e($message->comment) }}"
                                        data-date="{{ $message->created_at->format('Y-m-d H:i') }}"
                                    >
                                        مشاهده
                                    </button>

                                    {{-- حذف --}}
                                    <form method="POST" action="{{ route('admin.contact.destroy', $message->id) }}" onsubmit="return confirm('آیا از حذف این پیام اطمینان دارید؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center p-4">پیامی یافت نشد.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Modal برای نمایش جزئیات پیام --}}
<div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel" aria-hidden="true" dir="rtl">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewMessageModalLabel">مشاهده پیام</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
      </div>
      <div class="modal-body">
        <dl class="row">
          <dt class="col-sm-3">نام</dt>
          <dd class="col-sm-9" id="msg-fullname">—</dd>

          <dt class="col-sm-3">ایمیل</dt>
          <dd class="col-sm-9" id="msg-email">—</dd>

          <dt class="col-sm-3">تاریخ</dt>
          <dd class="col-sm-9" id="msg-date">—</dd>

          <dt class="col-sm-3">متن پیام</dt>
          <dd class="col-sm-9" id="msg-comment" style="white-space:pre-wrap;">—</dd>
        </dl>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var viewModal = document.getElementById('viewMessageModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        // گرفتن داده‌ها از data-attributes
        var fullname = button.getAttribute('data-fullname') || '—';
        var email = button.getAttribute('data-email') || '—';
        var comment = button.getAttribute('data-comment') || '—';
        var date = button.getAttribute('data-date') || '—';

        // قرار دادن در المان‌های مودال
        document.getElementById('msg-fullname').textContent = fullname;
        document.getElementById('msg-email').textContent = email;
        document.getElementById('msg-comment').textContent = comment;
        document.getElementById('msg-date').textContent = date;
    });
});
</script>
@endpush
