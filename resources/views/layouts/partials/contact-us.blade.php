<section id="contactus" class="contact-us position-relative overflow-hidden py-5">
    <div class="container d-block mb-4" data-aos="fade-down-left">
        <h3 class="line font-iransans-black">تماس با ما</h3>

        @if (session('success'))
            <div class="alert alert-success text-center mt-3">{{ session('success') }}</div>
        @endif

        <div class="box d-flex flex-column-reverse flex-md-row flex-wrap mt-5" data-aos="fade-left">
            <div class="col-12 col-md-6 text-center mt-5 mt-md-0">
                <img class="img" src="{{ asset('assets/images/contactus.png') }}" />
            </div>

            <form action="{{ route('contact.store') }}" method="POST" class="col-12 col-md-6 p-3">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                        id="fullname" name="fullname" maxlength="50" placeholder="نام را وارد کنید"
                        value="{{ old('fullname') }}" />
                    <label for="fullname">نام</label>
                    @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" name="email" maxlength="100" placeholder="ایمیل را وارد کنید"
                        value="{{ old('email') }}" />
                    <label for="email">ایمیل</label>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control @error('comment') is-invalid @enderror"
                        id="comment" name="comment" rows="5" maxlength="200"
                        placeholder="پیام را وارد کنید" style="height: 80px">{{ old('comment') }}</textarea>
                    <label for="comment">پیام</label>
                    @error('comment')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    ارسال <i class="mdi mdi-send mdi-rotate-225 ms-2"></i>
                </button>
            </form>
        </div>
    </div>

    <a id="scrollToTop" class="link scroll-to-top" href="#">
        <i class="mdi mdi-arrow-up mdi-24px"></i>
    </a>
</section>
