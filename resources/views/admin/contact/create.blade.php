

@section('title', 'افزودن شماره جدید')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">افزودن شماره تماس جدید</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.contacts.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label class="form-label">عنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="مثلاً پشتیبانی فروش">
        </div>

        <div class="mb-3">
            <label class="form-label">شماره تماس</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="مثلاً 09120000000">
        </div>

        <button type="submit" class="btn btn-success">ثبت شماره</button>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">بازگشت</a>
    </form>
</div>

