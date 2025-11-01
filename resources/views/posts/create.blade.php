@extends('layouts.app')

@section('title', 'افزودن نوشته جدید')

@section('content')
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row g-4">

            {{-- ✅ بخش اصلی ادیتور --}}
            <div class="col-lg-9">

                <form id="postForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- خطاها --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>خطا!</strong> لطفاً موارد زیر را بررسی کنید:
                            <ul class="mt-2 mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- عنوان پست --}}
                    <div class="mb-3">
                        <input type="text" name="title" 
                               class="form-control form-control-lg border-0 border-bottom fw-bold" 
                               style="font-size: 1.6rem;"
                               placeholder="عنوان را اینجا وارد کنید..." 
                               value="{{ old('title') }}" required>
                    </div>

                    {{-- ادیتور محتوا --}}
                    <div class="mb-4">
                        <textarea id="editor" name="content">{{ old('content') }}</textarea>
                    </div>

                    {{-- فقط برای موبایل --}}
                    <div class="d-lg-none mb-5">
                        <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                            <i class="bi bi-upload"></i> انتشار نوشته
                        </button>
                    </div>
                </form>
            </div>

            {{-- ✅ سایدبار تنظیمات پست --}}
            <div class="col-lg-3">

                {{-- انتشار --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold">انتشار</div>
                    <div class="card-body">
                        <button type="submit" form="postForm" class="btn btn-success w-100 mb-2">
                            <i class="bi bi-upload"></i> انتشار
                        </button>
                        <button type="button" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-eye"></i> پیش‌نمایش
                        </button>
                    </div>
                </div>

                {{-- تصویر شاخص --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold">تصویر شاخص</div>
                    <div class="card-body text-center">
                        <input type="file" name="image" class="form-control mb-3">
                        <small class="text-muted">فرمت مجاز: JPG, PNG, WEBP</small>
                    </div>
                </div>

                {{-- ✅ دسته‌بندی‌ها (چندتایی) --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold">دسته‌بندی‌ها</div>
                    <div class="card-body">
                        @if($categories->count() > 0)
                            <div class="d-flex flex-column gap-2">
                                @foreach($categories as $category)
                                    <div class="form-check">
                                        <input 
                                            type="checkbox" 
                                            name="categories[]" 
                                            value="{{ $category->id }}" 
                                            id="cat_{{ $category->id }}"
                                            class="form-check-input"
                                            {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cat_{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted small mb-0">هیچ دسته‌ای وجود ندارد.</p>
                            <a href="{{ route('categories.create') }}" class="small text-primary">افزودن دسته جدید</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: [
            'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
            '|', 'blockQuote', 'insertTable', 'undo', 'redo'
        ],
    })
    .then(editor => {
        const editable = editor.ui.view.editable.element;
        editable.style.minHeight = '550px';
        editable.style.maxHeight = '800px';
        editable.style.padding = '1rem';
        editable.style.overflowY = 'auto';

        const observer = new ResizeObserver(() => {
            editable.style.height = 'auto';
            editable.style.minHeight = '550px';
        });
        observer.observe(editable);
    })
    .catch(error => console.error(error));
</script>

<style>
.ck-editor__editable_inline {
    border: 1px solid #dcdcdc !important;
    border-radius: 6px;
    background: #fff;
    font-size: 15px;
    line-height: 1.8;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.ck-editor__editable_inline:focus {
    border-color: #0073aa !important;
    box-shadow: 0 0 0 2px rgba(0,115,170,0.2);
}
</style>
@endsection
