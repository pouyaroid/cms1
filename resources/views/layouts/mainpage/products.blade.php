<section id="products" class="products position-relative alternate overflow-hidden py-5">
    <div class="container d-block">

        {{-- عنوان بخش --}}
        <div class="title d-flex flex-column flex-md-row flex-wrap justify-content-between pt-5 px-3">
            <h3 class="line font-iransans-black col-12 col-md-6 my-0">محصولات ما</h3>
            <span class="d-block col-12 col-md-6 lh-lg">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
            </span>
        </div>

        {{-- بک‌گراند --}}
        <div class="shape-bg">
            <img src="{{ asset('assets/images/shape5.png') }}" alt="shape background" />
        </div>

        <div class="d-flex flex-column flex-md-row justify-content-start pt-5">
            {{-- کارت معرفی سمت راست --}}
            <div class="d-block col-12 col-lg-3 col-md-4 p-3">
                <div class="card d-flex flex-column justify-content-between align-items-center h-100 p-3">
                    <h4 class="font-iransans-black">محصولات ویژه</h4>
                    <img class="special-img my-4" src="{{ asset('assets/images/discount.svg') }}" alt="special products" />
                    <span class="d-block mb-3">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                    </span>
                    <a class="btn btn-primary w-100" href="#">مشاهده همه</a>
                </div>
            </div>

            {{-- بخش محصولات --}}
            <div class="col-12 col-lg-9 col-md-8">
                <div class="products-slider d-flex flex-wrap">
                    {{-- اگر دیتایی وجود دارد --}}
                    @if(isset($products) && $products->count() > 0)
                        @foreach($products as $product)
                            <div class="products-slider-item col-12 col-md-6 col-lg-3 p-3 mb-4">
                                <div class="card p-2 h-100 d-flex flex-column justify-content-between">
                                    <div class="header d-flex flex-row justify-content-center pt-3 mb-3">
                                        <img class="img" 
                                             src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/man1.png') }}" 
                                             alt="{{ $product->title }}">
                                    </div>
                                    <div class="body mb-3">
                                        <h6 class="d-block font-iransans-black text-center mb-2">{{ $product->title }}</h6>
                                        <span class="d-block small lh-base px-2 mb-3 text-center">
                                            {{ $product->description ?? 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است' }}
                                        </span>
                                        <h6 class="d-block font-iransans-black text-center">
                                            {{ $product->price ?? 'تماس بگیرید' }}
                                            @if(is_numeric($product->price))
                                                <small>تومان</small>
                                            @endif
                                        </h6>
                                    </div>
                                    <a class="btn btn-primary w-100" 
                                       href="{{ $product->link ?? '#' }}">مشاهده</a>
                                </div>
                            </div>
                        @endforeach

                    {{-- در غیر این صورت از داده‌های پیش‌فرض --}}
                    @else
                        @php
                            $defaultProducts = [
                                ['img' => 'man1.png', 'price' => '250,000,000', 'desc' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم...'],
                                ['img' => 'woman2.png', 'price' => '190,000,000', 'desc' => 'متن ساختگی برای پر کردن فضای خالی طراحی...'],
                                ['img' => 'man2.png', 'price' => '210,000,000', 'desc' => 'محصول با کیفیت فوق‌العاده و طراحی حرفه‌ای...'],
                                ['img' => 'man1.png', 'price' => '250,000,000', 'desc' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم...'],
                            ];
                        @endphp

                        @foreach($defaultProducts as $item)
                            <div class="products-slider-item col-12 col-md-6 col-lg-3 p-3 mb-4">
                                <div class="card p-2 h-100 d-flex flex-column justify-content-between">
                                    <div class="header d-flex flex-row justify-content-center pt-3 mb-3">
                                        <img class="img" src="{{ asset('assets/images/' . $item['img']) }}" alt="product">
                                    </div>
                                    <div class="body mb-3">
                                        <span class="d-block small lh-base px-2 mb-3 text-center">{{ $item['desc'] }}</span>
                                        <h6 class="d-block font-iransans-black text-center">
                                            {{ $item['price'] }} <small>تومان</small>
                                        </h6>
                                    </div>
                                    <a class="btn btn-primary w-100" href="#">مشاهده</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
