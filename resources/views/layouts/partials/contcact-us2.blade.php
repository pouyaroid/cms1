<div class="contact-us d-flex flex-column flex-md-row flex-wrap justify-content-between w-100 p-5">
    <div class="d-block mt-5 mt-md-0"></div>
    <div class="contact-us-phone d-flex flex-column flex-md-row flex-wrap justify-content-center align-items-center mt-5 mt-md-0">
        <span class="font-iransans-black d-block mx-4 mb-4 mb-md-0">
            {{ $contact->title ?? 'نیاز به مشاوره دارید؟' }}
        </span>
        <a class="btn btn-secondary font-iransans-black rounded-5" href="tel:{{ $contact->phone ?? '+982178355412' }}">
            {{ $contact->phone ?? '02178355412' }}
            <i class="mdi mdi-phone-in-talk-outline mdi-18px"></i>
        </a>
    </div>
</div>