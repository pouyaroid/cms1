<section id="portfolio" class="portfolio position-relative py-5">
    <div class="container d-block">
        <h3 class="line d-block font-iransans-black">نمونه کارهای من</h3>

        {{-- فیلتر دسته‌بندی --}}
        <div class="button-group filters-button-group text-center my-5">
            <button type="button" class="btn btn-light rounded-5 mx-1" data-filter="*">همه</button>
            <button type="button" class="btn btn-light rounded-5 mx-1" data-filter=".web">وبسایت</button>
            <button type="button" class="btn btn-light rounded-5 mx-1" data-filter=".mobile">اپ موبایل</button>
            <button type="button" class="btn btn-light rounded-5 mx-1" data-filter=".app">اپلیکیشن</button>
        </div>

        <div class="portfolio-grid" data-isotope='{ "itemSelector": ".portfolio-item", "layoutMode": "fitRows", "isOriginLeft": false }'>

            {{-- اگر دیتابیس خالی بود، از تصاویر و اطلاعات پیش‌فرض استفاده کن --}}
            @if($portfolios->isEmpty())
                @php
                    $defaults = [
                        ['img' => 'assets/images/portfolio/1.jpg', 'category' => 'web', 'title' => 'قالب رامَن', 'link' => '#'],
                        ['img' => 'assets/images/portfolio/2.jpg', 'category' => 'mobile', 'title' => 'اپلیکیشن فودمارکت', 'link' => '#'],
                        ['img' => 'assets/images/portfolio/3.jpg', 'category' => 'mobile', 'title' => 'اپ رزرو هتل', 'link' => '#'],
                        ['img' => 'assets/images/portfolio/4.jpg', 'category' => 'web', 'title' => 'سایت خبری تکنو', 'link' => '#'],
                        ['img' => 'assets/images/portfolio/5.jpg', 'category' => 'mobile', 'title' => 'اپ فروشگاهی', 'link' => '#'],
                        ['img' => 'assets/images/portfolio/6.jpg', 'category' => 'web', 'title' => 'وبسایت شرکتی', 'link' => '#'],
                        ['img' => 'assets/images/portfolio/7.jpg', 'category' => 'app', 'title' => 'داشبورد مدیریتی', 'link' => '#'],
                        ['img' => 'assets/images/portfolio/8.jpg', 'category' => 'app', 'title' => 'سیستم مدیریت محتوا', 'link' => '#'],
                    ];
                @endphp

                @foreach ($defaults as $item)
                    <div class="portfolio-item {{ $item['category'] }} col-6 col-md-3 p-1">
                        <img class="w-100" src="{{ asset($item['img']) }}" alt="{{ $item['title'] }}">
                        <div class="item-img-overlay">
                            <small class="d-block text-muted mb-3">نمونه کار</small>
                            <h6 class="fw-bold mb-3">{{ $item['title'] }}</h6>
                            <a class="link link-theme" href="{{ $item['link'] }}">
                                <i class="mdi mdi-link mdi-36px"></i>
                            </a>
                        </div>
                    </div>
                @endforeach

            {{-- اگر در دیتابیس داده وجود داشت --}}
            @else
                @foreach ($portfolios as $item)
                    <div class="portfolio-item {{ $item->category }} col-6 col-md-3 p-1">
                        <img class="w-100" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                        <div class="item-img-overlay">
                            <small class="d-block text-muted mb-3">نمونه کار</small>
                            <h6 class="fw-bold mb-3">{{ $item->title }}</h6>
                            @if($item->link)
                                <a class="link link-theme" href="{{ $item->link }}" target="_blank">
                                    <i class="mdi mdi-link mdi-36px"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section>
