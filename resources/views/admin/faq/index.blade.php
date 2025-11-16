@extends('layouts.app')

@section('title', 'مدیریت سوالات متداول')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>سوالات متداول</h3>
        <a href="{{ route('faqs.create') }}" class="btn btn-success">افزودن سوال جدید</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($faqs->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>سوال</th>
                        <th>پاسخ</th>
                        <th width="150">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                    <tr>
                        <td>{{ $faq->question }}</td>
                        <td>{{ Str::limit($faq->answer, 80) }}</td>
                        <td>
                            <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-warning btn-sm">ویرایش</a>

                            <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('آیا از حذف این مورد مطمئن هستید؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else
        <div class="alert alert-info">هیچ سوالی ثبت نشده است.</div>
    @endif

</div>
@endsection
