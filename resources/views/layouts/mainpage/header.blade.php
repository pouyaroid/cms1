@php
// اگر $menus وجود ندارد، یک Collection خالی بساز
if (!isset($menus)) {
    $menus = collect();
}

// منوهای پیش فرض اگر دیتابیس خالی بود
$defaultMenus = [
    [
        'title' => 'خانه',
        'slug' => 'index.html',
        'children' => []
    ],
    [
        'title' => 'وبلاگ',
        'slug' => 'blog.html',
        'children' => []
    ],
    [
        'title' => 'محصولات',
        'slug' => '#products',
        'children' => []
    ],
    [
        'title' => 'تعرفه ها',
        'slug' => '#pricing',
        'children' => []
    ],
    [
        'title' => 'نمونه کارها',
        'slug' => '#portfolio',
        'children' => []
    ],
    [
        'title' => 'پرسش‌های متداول',
        'slug' => '#faq',
        'children' => []
    ],
    [
        'title' => 'درباره ما',
        'slug' => '#',
        'children' => [
            ['title' => 'درباره ما', 'slug' => '#aboutus'],
            ['title' => 'تماس با ما', 'slug' => '#contactus'],
        ]
    ],
];
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a href="/">
            <img class="logo" src="assets/images/logo.png" />
        </a>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav navbar-items list-unstyled d-flex flex-column flex-md-row mb-0">
                @php
                    $menusToShow = $menus->isNotEmpty() ? $menus : collect($defaultMenus);
                @endphp

                @foreach($menusToShow as $menu)
                    @php
                        $children = isset($menu['children']) ? $menu['children'] : ($menu->children ?? []);
                    @endphp

                    <li class="nav-item @if(count($children)) dropdown @endif">
                        <a class="nav-link @if(count($children)) dropdown-toggle @endif lh-lg py-2 px-3"
                           @if(count($children)) data-bs-toggle="dropdown" aria-expanded="false" @endif
                           href="{{ $menu['slug'] ?? ($menu->slug ?? '#') }}">
                            {{ $menu['title'] ?? $menu->title }}
                        </a>

                        @if(count($children))
                            <ul class="dropdown-menu list-unstyled mb-0">
                                @foreach($children as $child)
                                    <li class="nav-item">
                                        <a class="nav-link lh-lg py-2 px-3" href="{{ $child['slug'] ?? ($child->slug ?? '#') }}">
                                            {{ $child['title'] ?? $child->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                {{-- لینک ثابت خرید قالب --}}
                <li class="nav-item">
                    <a class="nav-link fw-bold lh-lg py-2 px-3" href="https://www.rtl-theme.com/raman-html-template/">خرید قالب!</a>
                </li>
            </ul>
        </div>

        {{-- بخش انتخاب تم --}}
        <div class="theme-dropdown dropdown d-none d-md-flex">
            <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="theme-picker theme-picker-all"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="#" onclick="setTheme('theme-middle-blue')"><span class="theme-picker theme-picker-1"></span></a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="setTheme('theme-panton')"><span class="theme-picker theme-picker-2"></span></a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="setTheme('theme-persian-green')"><span class="theme-picker theme-picker-3"></span></a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="setTheme('theme-blue-cola')"><span class="theme-picker theme-picker-4"></span></a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="setTheme('theme-cameo')"><span class="theme-picker theme-picker-5"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
