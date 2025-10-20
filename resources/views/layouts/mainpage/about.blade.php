<section id="aboutus" class="about-us position-relative alternate py-5">
    <div class="container d-block" data-aos="fade-down-right">

        {{-- تصویر پس‌زمینه --}}
        <div class="shape-bg">
            <img src="{{ isset($about) && $about->background_shape 
                ? asset('storage/' . $about->background_shape) 
                : asset('assets/images/shape5.png') }}" 
            alt="shape" />
        </div>

        {{-- کارت‌های آمار --}}
        <div class="d-flex flex-column flex-md-row flex-wrap justify-content-start align-items-center text-center">

            {{-- کارت ۱ --}}
            <div class="col-12 col-lg-3 col-md-6 p-3">
                <div class="card d-flex flex-row justify-content-center align-items-center mt-0 mt-md-5">
                    <div class="body">
                        <h1 id="val1" 
                            class="font-iransans-black my-3" 
                            data-value="{{ $about->val1 ?? 33 }}">
                            {{ $about->val1 ?? 33 }}
                        </h1>
                        <span class="d-block">{{ $about->val1_label ?? 'محصول' }}</span>
                    </div>
                </div>
            </div>

            {{-- کارت ۲ --}}
            <div class="col-12 col-lg-3 col-md-6 p-3">
                <div class="card d-flex flex-row justify-content-center align-items-center p-4 mt-0 mt-md-2">
                    <div class="body">
                        <h1 id="val2" 
                            class="font-iransans-black my-3" 
                            data-value="{{ $about->val2 ?? 7000 }}">
                            {{ $about->val2 ?? 7000 }}
                        </h1>
                        <span class="d-block">{{ $about->val2_label ?? 'تعداد مشتریان' }}</span>
                    </div>
                </div>
            </div>

            {{-- کارت ۳ --}}
            <div class="col-12 col-lg-3 col-md-6 p-3">
                <div class="card d-flex flex-row justify-content-center align-items-center p-4 mt-0 mt-md-5">
                    <div class="body">
                        <h1 id="val3" 
                            class="font-iransans-black my-3" 
                            data-value="{{ $about->val3 ?? 18 }}">
                            {{ $about->val3 ?? 18 }}
                        </h1>
                        <span class="d-block">{{ $about->val3_label ?? 'مدرس' }}</span>
                    </div>
                </div>
            </div>

            {{-- کارت ۴ --}}
            <div class="col-12 col-lg-3 col-md-6 p-3">
                <div class="card d-flex flex-row justify-content-center align-items-center p-4">
                    <div class="body">
                        <h1 id="val4" 
                            class="font-iransans-black my-3" 
                            data-value="{{ $about->val4 ?? 15400 }}">
                            {{ $about->val4 ?? 15400 }}
                        </h1>
                        <span class="d-block">{{ $about->val4_label ?? 'نظر شرکت کننده' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- بخش متن و تصویر درباره ما --}}
        <div class="d-flex flex-column flex-md-row flex-wrap justify-content-start align-items-center pt-5">
            <div class="d-flex flex-column-reverse flex-md-row flex-wrap justify-content-start pt-5">

                {{-- تصویر --}}
                <div class="position-relative col-12 col-md-6">
                    <div class="image-container d-flex flex-row justify-content-center col-12 col-md-8 w-100">
                        <div class="box"></div>
                    </div>
                    <img class="image" 
                        src="{{ isset($about) && $about->image 
                            ? asset('storage/' . $about->image) 
                            : asset('assets/images/man.png') }}" 
                        alt="about image" />
                </div>

                {{-- متن --}}
                <div class="col-12 col-md-6 mb-5 mb-md-0">
                    <h3 class="line font-iransans-black mb-3">
                        {{ $about->title ?? 'درباره ما' }}
                    </h3>

                    <p class="d-block lh-lg">
                        {!! $about->description ?? 
                            'هدف ما کمک به رشد کسب و کارها با ایجاد یک رابطه خوب به‌وسیله مکالمه مستقیم و بدون واسطه مشتریان با شرکت شماست. مشتریان راضی‌تر و فروش بیشتر شرکت شما از اولویت‌های ماست. ما در بستر یک پلتفرم و کاملا واکنشگرا طراحی شده که می‌توانید از طریق کامپیوتر شخصی، موبایل و یا با تبلت خودتون در هر کجا که خواستید ازش استفاده کنید. هنوز اول راهیم...' !!}
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
