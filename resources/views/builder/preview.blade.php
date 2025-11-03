@extends('layouts.app')

@section('title', 'پیش‌نمایش خروجی')

@section('content')
<div class="container my-4">
    <h3 class="text-center mb-4">پیش‌نمایش خروجی HTML</h3>
    <div class="border p-3" style="min-height:400px;">
        {!! $html !!}
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('builder.index') }}" class="btn btn-primary">بازگشت به صفحه‌ساز</a>
    </div>
</div>
@endsection
