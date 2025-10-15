<section id="main" class="main pb-5">
    <div class="container d-flex flex-column-reverse flex-md-row">
        @php
            $subtitle = $hero->subtitle ?? 'کسب و کار آنلاینت رو راه اندازی کن';
            $title = $hero->title ?? 'روش های کاربردی کسب درآمد آنلاین';
            $description = $hero->description ?? 'ارائه دهنده ابزارهای لازم برای راه اندازی کسب و کار آنلاین در کمترین زمان و با کمترین هزینه';
            $highlight_text = $hero->highlight_text ?? 'کمترین زمان و با کمترین هزینه';
            $primary_btn_text = $hero->primary_button_text ?? 'شروع کنید';
            $primary_btn_link = $hero->primary_button_link ?? 'login.html';
            $secondary_btn_text = $hero->secondary_button_text ?? 'مشاوره بگیرید';
            $secondary_btn_link = $hero->secondary_button_link ?? '#';
            $main_image = $hero->main_image ? asset('storage/'.$hero->main_image) : asset('assets/images/woman1.png');
            $shape_image = $hero->shape_image ? asset('storage/'.$hero->shape_image) : asset('assets/images/shape5.png');
        @endphp

        {{-- ✅ متن سمت چپ --}}
        <div class="d-block col-12 col-md-4 pt-5 mb-lg-0" data-aos="fade-left">
            <span class="d-block">{{ $subtitle }}</span>
            <h1 class="font-pinar h2 lh-lg mb-4">{{ $title }}</h1>

            <p class="lh-lg mb-5">
                {!! str_replace(
                    $highlight_text,
                    '<span class="font-iransans-black hightlight">'.$highlight_text.'</span>',
                    e($description)
                ) !!}
            </p>

            <a class="btn btn-primary me-2" href="{{ $primary_btn_link }}">
                {{ $primary_btn_text }}
                <i class="mdi mdi-arrow-left mdi-18px"></i>
            </a>

            <a class="btn btn-primary-outline" href="{{ $secondary_btn_link }}">
                <i class="mdi mdi-phone-in-talk-outline mdi-18px"></i>
                {{ $secondary_btn_text }}
            </a>
        </div>

        {{-- ✅ تصویر سمت راست --}}
        <div class="image-container d-flex flex-row justify-content-end col-12 col-md-8">
            <div class="box">
                <div class="overflow-hidden">
                    <img class="image" src="{{ $main_image }}" alt="Hero image" />
                </div>
            </div>
        </div>

        {{-- ✅ تصویر پس‌زمینه --}}
        <div class="shape-bg">
            <img src="{{ $shape_image }}" alt="Shape background" />
        </div>
    </div>
</section>

