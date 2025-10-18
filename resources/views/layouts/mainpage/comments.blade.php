<section id="opinion" class="opinion position-relative pt-5">
    <div class="container d-flex flex-column-reverse flex-md-row overflow-hidden py-5">
        <div class="box d-block col-12 p-4 mb-5" data-aos="fade-right">

            {{-- عنوان و توضیحات بالا --}}
            <div class="title d-flex flex-column flex-md-row flex-wrap justify-content-between text-white pt-5">
                <h3 class="font-iransans-black col-12 col-md-6 my-0">نظرات شرکت کنندگان</h3>
                <div class="col-12 col-md-6">
                    <span class="d-block font-iransans-bold lh-lg mb-3">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                    </span>
                    <a class="btn btn-light btn-sm" href="{{ route('opinions.index') }}">
                        مشاهده همه
                        <i class="mdi mdi-arrow-left mdi-18px"></i>
                    </a>
                </div>
            </div>

            <div class="dot1"></div>
            <div class="dot2"></div>

            {{-- اگر دیتا در دیتابیس وجود داشت --}}
            @if(isset($opinions) && $opinions->count() > 0)
                <ul class="list list-unstyled d-flex flex-row flex-wrap justify-content-center font-iransans-medium px-0 px-md-5 mb-0">
                    @foreach($opinions as $opinion)
                        <li class="list-item col-12 col-md-6 p-2">
                            <div class="card p-4">
                                <div class="body">
                                    <small class="d-block lh-lg">
                                        {{ $opinion->comment }}
                                    </small>
                                </div>
                                <div class="footer d-flex flex-row justify-content-start align-items-start pt-4">
                                    <img class="avatar"
                                         src="{{ $opinion->avatar ? asset('storage/'.$opinion->avatar) : asset('assets/images/default-user.jpg') }}"
                                         alt="{{ $opinion->name }}">
                                    <small class="d-flex flex-column flex-fill px-3">
                                        <span class="d-block mb-2">{{ $opinion->name }}</span>
                                        <small class="d-block text-muted">{{ $opinion->role ?? 'شرکت کننده' }}</small>
                                    </small>
                                    <small class="date rounded-5 py-1 px-2">
                                        <small class="d-block text-muted text-center">
                                            {{ \Carbon\Carbon::parse($opinion->date)->format('d F Y') }}
                                        </small>
                                    </small>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            {{-- اگر دیتایی وجود نداشت از HTML پیش‌فرض استفاده شود --}}
            @else
                <ul class="list list-unstyled d-flex flex-row flex-wrap justify-content-center font-iransans-medium px-0 px-md-5 mb-0">
                    <li class="list-item col-12 col-md-6 p-2">
                        <div class="card p-4">
                            <div class="body">
                                <small class="d-block lh-lg">
                                    اگر اولویت کسب وکار شما ارائه خدمات با کیفیت به مشتریان‌تون با هدف بالا بردن فروش و پاسخگویی در کمترین زمان هست به نظر من سرویس های رامَن بهترین گزینه برای شما خواهد بود.
                                </small>
                            </div>
                            <div class="footer d-flex flex-row justify-content-start align-items-start pt-4">
                                <img class="avatar" src="{{ asset('assets/images/user1.jpg') }}" alt="user1">
                                <small class="d-flex flex-column flex-fill px-3">
                                    <span class="d-block mb-2">امیر رضایی</span>
                                    <small class="d-block text-muted">شرکت کننده</small>
                                </small>
                                <small class="date rounded-5 py-1 px-2">
                                    <small class="d-block text-muted">20 تیر 1401</small>
                                </small>
                            </div>
                        </div>
                    </li>

                    <li class="list-item col-12 col-md-6 p-2">
                        <div class="card p-4">
                            <div class="body">
                                <small class="d-block lh-lg">
                                    سرویس های رامَن یکی از بهترین راهکارها برای کمک به افزایش نرخ تبدیل در کسب و کارهاست و به عنوان یک سرویس موفق ایرانی می تواند بستر مناسبی برای پیاده سازی فرآیند بازاریابی باشد.
                                </small>
                            </div>
                            <div class="footer d-flex flex-row justify-content-start align-items-start pt-4">
                                <img class="avatar" src="{{ asset('assets/images/user2.jpg') }}" alt="user2">
                                <small class="d-flex flex-column flex-fill px-3">
                                    <span class="d-block mb-2">لیلا اسدی</span>
                                    <small class="d-block text-muted">شرکت کننده</small>
                                </small>
                                <small class="date rounded-5 py-1 px-2">
                                    <small class="d-block text-muted text-center">21 مرداد 1401</small>
                                </small>
                            </div>
                        </div>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</section>
