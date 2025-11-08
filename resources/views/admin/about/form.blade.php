@php
    $isEdit = isset($about);
@endphp

<form action="{{ $isEdit ? route('about.update', $about->id) : route('about.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">عنوان</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $about->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">توضیحات</label>
        <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $about->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">تصویر اصلی</label>
        <input type="file" name="image" id="image" class="form-control">
        @if($isEdit && $about->image)
            <img src="{{ asset('storage/' . $about->image) }}" alt="تصویر" class="img-thumbnail mt-2" width="150">
        @endif
    </div>

    <div class="mb-3">
        <label for="background_shape" class="form-label">شکل پس‌زمینه</label>
        <input type="file" name="background_shape" id="background_shape" class="form-control">
        @if($isEdit && $about->background_shape)
            <img src="{{ asset('storage/' . $about->background_shape) }}" alt="شکل پس‌زمینه" class="img-thumbnail mt-2" width="150">
        @endif
    </div>

    @for($i = 1; $i <= 4; $i++)
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="val{{ $i }}" class="form-label">مقدار {{ $i }}</label>
                <input type="number" name="val{{ $i }}" id="val{{ $i }}" class="form-control" value="{{ old('val'.$i, $about->{'val'.$i} ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="val{{ $i }}_label" class="form-label">برچسب {{ $i }}</label>
                <input type="text" name="val{{ $i }}_label" id="val{{ $i }}_label" class="form-control" value="{{ old('val'.$i.'_label', $about->{'val'.$i.'_label'} ?? '') }}">
            </div>
        </div>
    @endfor

    <button type="submit" class="btn btn-success">{{ $isEdit ? 'به‌روزرسانی' : 'ثبت' }}</button>
</form>
