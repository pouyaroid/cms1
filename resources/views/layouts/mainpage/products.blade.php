<section id="products" class="products position-relative alternate overflow-hidden py-5">
    <div class="container">

        {{-- 🟢 عنوان بخش --}}
        <div class="title d-flex flex-column flex-md-row flex-wrap justify-content-between align-items-center pt-5 px-3">
            <h3 class="line font-iransans-black col-12 col-md-6 my-0">محصولات ما</h3>
            <span class="d-block col-12 col-md-6 lh-lg text-muted text-md-end">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
            </span>
        </div>

        {{-- 🟣 بک‌گراند تزئینی --}}
        <div class="shape-bg position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
            <img src="{{ asset('assets/images/shape5.png') }}" class="w-100 h-100 object-fit-cover opacity-25" alt="shape background">
        </div>

        <div class="row position-relative pt-5">
            {{-- 🟡 کارت معرفی ویژه --}}
            <div class="col-12 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 text-center p-4 shadow-sm">
                    <h4 class="font-iransans-black mb-3">محصولات ویژه</h4>
                    <img src="{{ asset('assets/images/discount.svg') }}" class="my-3" width="80" alt="special products">
                    <p class="small text-muted mb-4">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ است.
                    </p>
                    <a href="#" class="btn btn-primary w-100">مشاهده همه</a>
                </div>
            </div>

            {{-- 🟢 بخش محصولات --}}
            <div class="col-12 col-md-8 col-lg-9">
                <div class="row">
                    @if(isset($products) && $products->count() > 0)
                        @foreach($products as $product)
                            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                <div class="card h-100 p-3 shadow-sm d-flex flex-column justify-content-between">
                                    <div class="text-center">
                                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/man1.png') }}"
                                             class="img-fluid rounded mb-3" 
                                             alt="{{ $product->title }}">
                                    </div>
                                    <div class="text-center mb-3">
                                        <h6 class="font-iransans-black mb-2">{{ $product->title }}</h6>
                                        <p class="small text-muted">{{ Str::limit($product->description, 80) ?? 'توضیحات محصول در دسترس نیست.' }}</p>
                                        <h6 class="fw-bold mt-3">
                                            {{ $product->price ? number_format($product->price) . ' تومان' : 'تماس بگیرید' }}
                                        </h6>
                                    </div>
                                    <a href="{{ $product->link ?? '#' }}" class="btn btn-outline-primary w-100 mt-auto">مشاهده</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- 🔵 داده پیش‌فرض --}}
                        @php
                            $defaultProducts = [
                                ['img' => 'man1.png', 'title' => 'محصول ۱', 'price' => '۲۵۰,۰۰۰', 'desc' => 'لورم ایپسوم متن ساختگی برای نمایش نمونه محصول'],
                                ['img' => 'woman2.png', 'title' => 'محصول ۲', 'price' => '۱۹۰,۰۰۰', 'desc' => 'متن ساختگی جهت پر کردن محتوا در طراحی'],
                                ['img' => 'man2.png', 'title' => 'محصول ۳', 'price' => '۲۱۰,۰۰۰', 'desc' => 'محصول با کیفیت فوق‌العاده و طراحی حرفه‌ای'],
                                ['img' => 'man1.png', 'title' => 'محصول ۴', 'price' => '۲۵۰,۰۰۰', 'desc' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم'],
                            ];
                        @endphp

                        @foreach($defaultProducts as $item)
                            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                <div class="card h-100 p-3 shadow-sm d-flex flex-column justify-content-between">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/' . $item['img']) }}" class="img-fluid rounded mb-3" alt="product">
                                    </div>
                                    <div class="text-center mb-3">
                                        <h6 class="font-iransans-black mb-2">{{ $item['title'] }}</h6>
                                        <p class="small text-muted">{{ $item['desc'] }}</p>
                                        <h6 class="fw-bold mt-3">{{ $item['price'] }} <small>تومان</small></h6>
                                    </div>
                                    <a href="#" class="btn btn-outline-primary w-100 mt-auto">مشاهده</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
