<section id="customers" class="customers overflow-hidden pb-5">
    <div class="container d-block">
        <div class="employer-slider" data-aos="fade-down-right">
            @forelse ($customers as $customer)
                @php
                    // اگر مسیر لوگوی آپلود شده وجود داشته باشد از storage استفاده کن
                    $logo = $customer->logo_path 
                        ? asset('storage/' . $customer->logo_path) 
                        : asset('assets/images/customers/' . strtolower($customer->name) . '.svg');
                @endphp
                <a class="link employer-link d-flex flex-row justify-content-center align-items-center" 
                   href="{{ $customer->website_url ?: '#' }}" 
                   target="_blank" 
                   rel="noopener">
                    <img class="employer-logo" 
                         src="{{ $logo }}" 
                         alt="{{ $customer->name }}" />
                </a>
            @empty
                {{-- نمایش تصاویر پیش‌فرض در صورت عدم وجود داده در دیتابیس --}}
                <a class="link employer-link d-flex flex-row justify-content-center align-items-center" href="#" target="_blank" rel="noopener">
                    <img class="employer-logo" src="{{ asset('assets/images/customers/amazon.svg') }}" />
                </a>
                <a class="link employer-link d-flex flex-row justify-content-center align-items-center" href="#" target="_blank" rel="noopener">
                    <img class="employer-logo" src="{{ asset('assets/images/customers/google.svg') }}" />
                </a>
                <a class="link employer-link d-flex flex-row justify-content-center align-items-center" href="#" target="_blank" rel="noopener">
                    <img class="employer-logo" src="{{ asset('assets/images/customers/lenovo.svg') }}" />
                </a>
                <a class="link employer-link d-flex flex-row justify-content-center align-items-center" href="#" target="_blank" rel="noopener">
                    <img class="employer-logo" src="{{ asset('assets/images/customers/microsoft.svg') }}" />
                </a>
                <a class="link employer-link d-flex flex-row justify-content-center align-items-center" href="#" target="_blank" rel="noopener">
                    <img class="employer-logo" src="{{ asset('assets/images/customers/paypal.svg') }}" />
                </a>
                <a class="link employer-link d-flex flex-row justify-content-center align-items-center" href="#" target="_blank" rel="noopener">
                    <img class="employer-logo" src="{{ asset('assets/images/customers/shopify.svg') }}" />
                </a>
                <a class="link employer-link d-flex flex-row justify-content-center align-items-center" href="#" target="_blank" rel="noopener">
                    <img class="employer-logo" src="{{ asset('assets/images/customers/spotify.svg') }}" />
                </a>
            @endforelse
        </div>
    </div>
</section>
