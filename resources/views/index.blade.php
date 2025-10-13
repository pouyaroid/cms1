<!DOCTYPE html>
<html lang="fa" dir="rtl">
	<head>
		<title>قالب رامَن</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<meta name="publisher" content="قالب رامَن" />
		<meta name="title" content="قالب رامَن" />
		<meta name="description" content="قالب رامَن" />

		<meta http-equiv="content-language" content="fa" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

		<link rel="stylesheet" href="assets/fonts/@mdi/css/materialdesignicons.min.css" />

		<link id="bootstraplink" rel="stylesheet" href="assets/css/bootstrap-5.2.0/css/bootstrap.rtl.min.css" />

		<script src="assets/js/jquery.min.js"></script>

		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

		<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
		<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.3.2/countUp.umd.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js"></script>

		<link rel="stylesheet" href="assets/css/styles.min.css" />
		<link rel="stylesheet" href="assets/css/index.min.css" />
	</head>

	<body class="theme-middle-blue">
		<div class="preloader">
			<div class="loader">
				<div class="dot"></div>
				<div class="dot"></div>
				<div class="dot"></div>
				<div class="dot"></div>
				<div class="dot"></div>
			</div>
		</div>



		@include('layouts.mainpage.header')
		
		@include('layouts.mainpage.herobanner')
		@include('layouts.mainpage.whyus')

		@include('layouts.mainpage.customer')

		@include('layouts.mainpage.products')
		@include('layouts.mainpage.about')
		

			@include('layouts.partials.contcact-us2')

		<section id="news" class="news position-relative alternate overflow-hidden py-5">
			<div class="container d-block" data-aos="fade-down-left">
				<div class="d-flex flex-column flex-md-row flex-wrap justify-content-between align-items-start py-5 px-3">
					<h3 class="line font-iransans-black col-12 col-md-6 my-0"> آخرین مقالات </h3>

					<a class="btn btn-light btn-sm" href="blog.html">
						مشاهده همه
						<i class="mdi mdi-arrow-left mdi-18px"></i>
					</a>
				</div>

				<div class="d-flex flex-column flex-md-row flex-wrap justify-content-start align-items-start">
					<div class="col-12 col-md-6 p-3">
						<div class="card news-item news-item-1 p-2 mb-4">
							<div class="body text-center">
								<img class="image" src="./assets/images/woman1.png" />
							</div>
						</div>
						<div class="d-flex flex-column">
							<a class="font-iransans-bold d-block lh-lg small mb-2" href="blog-detail.html"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است </a>
							<small class="d-block text-muted">26 مرداد 1401</small>
						</div>
					</div>
					<div class="news-list col-12 col-md-6 p-0 p-md-3">
						<div class="news-list-item news-item-2 d-flex flex-row align-items-start pb-2 mb-2">
							<div class="card news-item news-item-small me-4 p-1">
								<div class="body text-center">
									<img class="image" src="./assets/images/man1.png" />
								</div>
							</div>
							<div class="d-flex flex-column">
								<a class="font-iransans-bold d-block lh-lg small mb-2" href="blog-detail.html"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است </a>
								<small class="d-block text-muted">26 مرداد 1401</small>
							</div>
						</div>
						<div class="news-list-item news-item-3 d-flex flex-row align-items-start pb-2 mb-2">
							<div class="card news-item news-item-small me-4 p-1">
								<div class="body text-center">
									<img class="image" src="./assets/images/woman2.png" />
								</div>
							</div>
							<div class="d-flex flex-column">
								<a class="font-iransans-bold d-block lh-lg small mb-2" href="blog-detail.html"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است </a>
								<small class="d-block text-muted">26 مرداد 1401</small>
							</div>
						</div>
						<div class="news-list-item news-item-4 d-flex flex-row align-items-start pb-2 mb-2">
							<div class="card news-item news-item-small me-4 p-1">
								<div class="body text-center">
									<img class="image" src="./assets/images/man2.png" />
								</div>
							</div>
							<div class="d-flex flex-column">
								<a class="font-iransans-bold d-block lh-lg small mb-2" href="blog-detail.html"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است </a>
								<small class="d-block text-muted">26 مرداد 1401</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>




		@include('layouts.mainpage.comments')
		@include('layouts.mainpage.team')
		@include('layouts.mainpage.portfolio')
		@include('layouts.mainpage.plans')

		@include('layouts.partials.AskedQuestions')
        @include('layouts.partials.contact-us')

		 @include('layouts.partials.footer')


		<script type="text/javascript" src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
		<script type="text/javascript" src="assets/css/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>

		<script type="text/javascript" src="assets/js/main.js"></script>
		<script type="text/javascript" src="assets/js/index.js"></script>
	</body>
</html>
