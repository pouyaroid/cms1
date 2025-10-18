<section id="team" class="team position-relative">
    <div class="container d-flex flex-column-reverse flex-md-row overflow-hidden py-5">
        <div class="box d-flex flex-row flex-wrap p-4 mb-5" data-aos="fade-left">
            <div class="d-flex flex-column flex-md-row flex-wrap justify-content-between align-items-start col-12 col-md-4 py-5">
                <h3 class="line font-iransans-black"> تیم ما </h3>

                <p class="d-block lh-lg">
                    {{ $teamDescription ?? 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد' }}
                </p>
            </div>

            <div class="col-12 col-md-8 ps-3">
                @if(isset($teamMembers) && count($teamMembers) > 0)
                    {{-- نمایش داده‌های واقعی از دیتابیس --}}
                    <ul class="list-unstyled d-flex flex-row flex-wrap ps-0 mb-0">
                        @foreach ($teamMembers as $member)
                            <li class="col-4 p-2">
                                <div class="card p-1">
                                    <div class="portfolio-item">
                                        <img class="img w-100"
                                             src="{{ asset('storage/' . $member->image) }}"
                                             alt="{{ $member->name }}">
                                        <div class="item-img-overlay">
                                            <small class="d-block text-muted mb-3">{{ $member->role }}</small>
                                            <h6 class="fw-bold mb-3">{{ $member->name }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    {{-- نمایش داده‌های پیش‌فرض --}}
                    <ul class="list-unstyled d-flex flex-row flex-wrap ps-0 mb-0">
                        @php
                            $defaultTeam = [
                                ['img' => 'assets/images/team1.jpg', 'role' => 'سئو', 'name' => 'رونی جفرا'],
                                ['img' => 'assets/images/team2.jpg', 'role' => 'تحلیلگر', 'name' => 'جنیفر'],
                                ['img' => 'assets/images/team3.jpg', 'role' => 'توسعه دهنده', 'name' => 'ماریا'],
                                ['img' => 'assets/images/team4.jpg', 'role' => 'کارگردان', 'name' => 'لوسی'],
                                ['img' => 'assets/images/team5.jpg', 'role' => 'توسعه دهنده', 'name' => 'میاکل'],
                                ['img' => 'assets/images/team6.jpg', 'role' => 'توسعه دهنده', 'name' => 'کالوین لورس'],
                            ];
                        @endphp

                        @foreach ($defaultTeam as $member)
                            <li class="col-4 p-2">
                                <div class="card p-1">
                                    <div class="portfolio-item">
                                        <img class="img w-100" src="{{ asset($member['img']) }}" alt="{{ $member['name'] }}">
                                        <div class="item-img-overlay">
                                            <small class="d-block text-muted mb-3">{{ $member['role'] }}</small>
                                            <h6 class="fw-bold mb-3">{{ $member['name'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section>
