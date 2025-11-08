<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت شرکت</title>
    
    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vazir Font -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #1e40af;
            --secondary-color: #3b82f6;
            --success-color: #059669;
            --danger-color: #dc2626;
            --warning-color: #d97706;
            --info-color: #0891b2;
            --dark-bg: #1f2937;
            --dark-sidebar: #111827;
            --dark-card: #374151;
            --dark-text: #f3f4f6;
        }

        * {
            font-family: 'Vazir', sans-serif;
        }

        body {
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        body.dark-mode {
            background-color: var(--dark-bg);
            color: var(--dark-text);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        body.dark-mode .sidebar {
            background: linear-gradient(135deg, var(--dark-sidebar), #1e293b);
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            color: white;
            margin: 0;
            font-size: 1.5rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            display: block;
            padding: 0.875rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-right: 3px solid transparent;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-right-color: white;
        }

        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            border-right-color: white;
        }

        .menu-item i {
            margin-left: 0.75rem;
            width: 20px;
        }

        /* Main Content */
        .main-content {
            margin-right: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        body.dark-mode .top-bar {
            background: var(--dark-card);
            color: var(--dark-text);
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        body.dark-mode .search-box input {
            background: var(--dark-bg);
            border-color: #4b5563;
            color: var(--dark-text);
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .theme-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        body.dark-mode .theme-toggle {
            color: var(--dark-text);
        }

        .theme-toggle:hover {
            color: var(--primary-color);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        body.dark-mode .card {
            background: var(--dark-card);
            color: var(--dark-text);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid #e5e7eb;
            padding: 1.25rem;
        }

        body.dark-mode .card-header {
            border-bottom-color: #4b5563;
        }

        /* Stats Cards */
        .stat-card {
            padding: 1.5rem;
            border-radius: 0.75rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-card.primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .stat-card.success {
            background: linear-gradient(135deg, var(--success-color), #047857);
        }

        .stat-card.warning {
            background: linear-gradient(135deg, var(--warning-color), #b45309);
        }

        .stat-card.danger {
            background: linear-gradient(135deg, var(--danger-color), #b91c1c);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
        }

        /* Tables */
        .table {
            background: transparent;
        }

        body.dark-mode .table {
            color: var(--dark-text);
        }

        body.dark-mode .table thead th {
            background: var(--dark-bg);
            border-color: #4b5563;
        }

        body.dark-mode .table tbody td {
            border-color: #4b5563;
        }

        /* Forms */
        .form-control, .form-select {
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: var(--dark-bg);
            border-color: #4b5563;
            color: var(--dark-text);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(30, 64, 175, 0.25);
        }

        /* Mobile Responsive */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #6b7280;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-right: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .search-box {
                width: 200px;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        body.dark-mode ::-webkit-scrollbar-track {
            background: #374151;
        }

        body.dark-mode ::-webkit-scrollbar-thumb {
            background: #6b7280;
        }

        /* Company Specific Styles */
        .company-info {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        body.dark-mode .company-info {
            background: linear-gradient(135deg, #1e3a8a, #1e40af);
        }

        .service-card {
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
        }

        body.dark-mode .service-card {
            border-color: #4b5563;
            background: var(--dark-bg);
        }

        .service-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .team-member {
            text-align: center;
            padding: 1rem;
        }

        .team-member img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 0.75rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-building"></i> پنل مدیریت</h3>
        </div>
        <div class="sidebar-menu">
            <a href="#" class="menu-item active" data-page="dashboard">
                <i class="fas fa-home"></i>
                <span>داشبورد</span>
            </a>
            <a href="#" class="menu-item" data-page="header">
                <i class="fas fa-header"></i>
                <span>مدیریت هدر</span>
            </a>
            <a href="#" class="menu-item" data-page="footer">
                <i class="fas fa-grip-lines"></i>
                <span>مدیریت فوتر</span>
            </a>
            <a href="#" class="menu-item" data-page="contact">
                <i class="fas fa-envelope"></i>
                <span>تماس با ما</span>
            </a>
            <a href="#" class="menu-item" data-page="pages">
                <i class="fas fa-file-alt"></i>
                <span>مدیریت صفحات</span>
            </a>
            <a href="#" class="menu-item" data-page="services">
                <i class="fas fa-concierge-bell"></i>
                <span>خدمات شرکت</span>
            </a>
            <a href="#" class="menu-item" data-page="team">
                <i class="fas fa-users"></i>
                <span>تیم مدیریت</span>
            </a>
            <a href="#" class="menu-item" data-page="projects">
                <i class="fas fa-project-diagram"></i>
                <span>پروژه‌ها</span>
            </a>
            <a href="#" class="menu-item" data-page="careers">
                <i class="fas fa-briefcase"></i>
                <span>فرصت‌های شغلی</span>
            </a>
            <a href="#" class="menu-item" data-page="users">
                <i class="fas fa-user-friends"></i>
                <span>مدیریت کاربران</span>
            </a>
            <a href="#" class="menu-item" data-page="settings">
                <i class="fas fa-cog"></i>
                <span>تنظیمات سایت</span>
            </a>
            <a href="#" class="menu-item" data-page="analytics">
                <i class="fas fa-chart-line"></i>
                <span>آمار و تحلیل</span>
            </a>
            <a href="#" class="menu-item" data-page="media">
                <i class="fas fa-images"></i>
                <span>مدیریت رسانه</span>
            </a>
            <a href="#" class="menu-item" data-page="comments">
                <i class="fas fa-comments"></i>
                <span>مدیریت نظرات</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="mb-0 me-3" id="pageTitle">داشبورد</h4>
            </div>
            <div class="top-actions">
                <div class="search-box">
                    <input type="text" placeholder="جستجو...">
                    <i class="fas fa-search"></i>
                </div>
                <button class="theme-toggle" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </button>
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none" data-bs-toggle="dropdown">
                        <img src="https://picsum.photos/seed/admin/40/40" alt="Admin" class="rounded-circle">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>پروفایل</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>تنظیمات</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>خروج</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="container-fluid p-4">
            <!-- Dashboard Page -->
            <div id="dashboard-page" class="page-content">
                <!-- Company Info -->
                <div class="company-info">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="mb-2">به پنل مدیریت شرکت خوش آمدید</h4>
                            <p class="mb-0">از این پنل برای مدیریت کامل وبسایت شرکت خود استفاده کنید</p>
                        </div>
                        <div class="col-md-4 text-start">
                            <button class="btn btn-primary"><i class="fas fa-plus me-2"></i>افزودن محتوا</button>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stat-card primary">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">بازدیدکنندگان</h6>
                                    <h3 class="mb-0">24,567</h3>
                                    <small class="opacity-75">+12% از ماه گذشته</small>
                                </div>
                                <i class="fas fa-eye fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stat-card success">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">صفحات سایت</h6>
                                    <h3 class="mb-0">48</h3>
                                    <small class="opacity-75">3 صفحه جدید</small>
                                </div>
                                <i class="fas fa-file-alt fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stat-card warning">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">پیام‌ها</h6>
                                    <h3 class="mb-0">156</h3>
                                    <small class="opacity-75">12 خوانده نشده</small>
                                </div>
                                <i class="fas fa-envelope fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stat-card danger">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">کاربران</h6>
                                    <h3 class="mb-0">1,234</h3>
                                    <small class="opacity-75">+45 جدید</small>
                                </div>
                                <i class="fas fa-users fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row mb-4">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">نمودار بازدید</h5>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary">هفته</button>
                                    <button class="btn btn-primary">ماه</button>
                                    <button class="btn btn-outline-primary">سال</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="visitChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">توزیع ترافیک</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="trafficChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities & Services -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">فعالیت‌های اخیر</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-item d-flex align-items-start mb-3">
                                    <div class="activity-icon bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">کاربر جدید ثبت نام کرد</h6>
                                        <small class="text-muted">علی رضایی - 2 دقیقه پیش</small>
                                    </div>
                                </div>
                                <div class="activity-item d-flex align-items-start mb-3">
                                    <div class="activity-icon bg-success bg-opacity-10 text-success rounded-circle p-2 me-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">پیام جدید دریافت شد</h6>
                                        <small class="text-muted">سارا محمدی - 15 دقیقه پیش</small>
                                    </div>
                                </div>
                                <div class="activity-item d-flex align-items-start mb-3">
                                    <div class="activity-icon bg-warning bg-opacity-10 text-warning rounded-circle p-2 me-3">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">صفحه جدید ایجاد شد</h6>
                                        <small class="text-muted">درباره ما - 1 ساعت پیش</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">خدمات پر بازدید</h5>
                                <a href="#" class="btn btn-sm btn-outline-primary">مشاهده همه</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="service-card">
                                            <i class="fas fa-laptop-code fa-2x text-primary mb-2"></i>
                                            <h6>مشاوره فنی</h6>
                                            <small class="text-muted">1,234 بازدید</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="service-card">
                                            <i class="fas fa-chart-line fa-2x text-success mb-2"></i>
                                            <h6>تحلیل کسب‌وکار</h6>
                                            <small class="text-muted">987 بازدید</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="service-card">
                                            <i class="fas fa-shield-alt fa-2x text-warning mb-2"></i>
                                            <h6>امنیت شبکه</h6>
                                            <small class="text-muted">876 بازدید</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="service-card">
                                            <i class="fas fa-cloud fa-2x text-info mb-2"></i>
                                            <h6>راه‌حل‌های ابری</h6>
                                            <small class="text-muted">765 بازدید</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Management Page -->
            <div id="header-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">مدیریت هدر سایت</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">لوگو شرکت</label>
                                    <input type="file" class="form-control" accept="image/*">
                                    <small class="text-muted">فرمت‌های مجاز: PNG, JPG, SVG</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">نام شرکت</label>
                                    <input type="text" class="form-control" value="نام شرکت شما">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">منوی اصلی</label>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>عنوان</th>
                                                <th>لینک</th>
                                                <th>ترتیب</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>صفحه اصلی</td>
                                                <td>/</td>
                                                <td>1</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>درباره ما</td>
                                                <td>/about</td>
                                                <td>2</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>خدمات</td>
                                                <td>/services</td>
                                                <td>3</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>تماس با ما</td>
                                                <td>/contact</td>
                                                <td>4</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-primary mt-2"><i class="fas fa-plus me-2"></i>افزودن آیتم جدید</button>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">شماره تلفن</label>
                                    <input type="tel" class="form-control" value="021-12345678">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ایمیل شرکت</label>
                                    <input type="email" class="form-control" value="info@company.com">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">رنگ پس‌زمینه هدر</label>
                                <input type="color" class="form-control form-control-color" value="#1e40af">
                            </div>
                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer Management Page -->
            <div id="footer-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">مدیریت فوتر سایت</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">درباره شرکت</label>
                                    <textarea class="form-control" rows="4">شرکت ما با بیش از 20 سال سابقه در زمینه ارائه خدمات حرفه‌ای به سازمان‌ها و شرکت‌ها فعالیت می‌کند...</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">لینک‌های سریع</label>
                                    <div class="mb-2">
                                        <input type="text" class="form-control mb-2" placeholder="عنوان لینک">
                                        <input type="url" class="form-control" placeholder="آدرس لینک">
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-plus me-1"></i>افزودن لینک</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">شبکه‌های اجتماعی</label>
                                    <div class="d-flex gap-2 mb-2">
                                        <select class="form-select">
                                            <option>لینکدین</option>
                                            <option>اینستاگرام</option>
                                            <option>تلگرام</option>
                                            <option>توییتر</option>
                                        </select>
                                        <input type="url" class="form-control" placeholder="آدرس پروفایل">
                                        <button class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">آدرس شرکت</label>
                                    <textarea class="form-control" rows="3">تهران، خیابان ولیعصر، پلاک 123</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">کپی‌رایت</label>
                                <input type="text" class="form-control" value="© 2024 شرکت شما. تمامی حقوق محفوظ است">
                            </div>
                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Management Page -->
            <div id="contact-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">پیام‌های تماس با ما</h5>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-download me-1"></i>خروجی اکسل</button>
                            <button class="btn btn-sm btn-primary"><i class="fas fa-sync me-1"></i>به‌روزرسانی</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>نام و نام خانوادگی</th>
                                        <th>شرکت</th>
                                        <th>ایمیل</th>
                                        <th>موضوع</th>
                                        <th>تاریخ</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>احمد محمدی</td>
                                        <td>شرکت الف</td>
                                        <td>ahmad@example.com</td>
                                        <td>همکاری</td>
                                        <td>1403/01/15</td>
                                        <td><span class="badge bg-warning">در انتظار پاسخ</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#viewMessageModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-success me-1"><i class="fas fa-reply"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>زهرا حسینی</td>
                                        <td>شرکت ب</td>
                                        <td>zahra@example.com</td>
                                        <td>مشاوره</td>
                                        <td>1403/01/14</td>
                                        <td><span class="badge bg-success">پاسخ داده شده</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#viewMessageModal"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-success me-1"><i class="fas fa-reply"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Management Page -->
            <div id="services-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">مدیریت خدمات شرکت</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                            <i class="fas fa-plus me-2"></i>افزودن خدمت جدید
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-laptop-code fa-3x text-primary mb-3"></i>
                                        <h5>مشاوره فنی</h5>
                                        <p class="text-muted">ارائه مشاوره تخصصی در زمینه فناوری اطلاعات</p>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-chart-line fa-3x text-success mb-3"></i>
                                        <h5>تحلیل کسب‌وکار</h5>
                                        <p class="text-muted">بهینه‌سازی فرآیندهای کسب‌وکار شما</p>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-shield-alt fa-3x text-warning mb-3"></i>
                                        <h5>امنیت شبکه</h5>
                                        <p class="text-muted">محافظت از داده‌ها و زیرساخت شما</p>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Management Page -->
            <div id="team-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">تیم مدیریت شرکت</h5>
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>افزودن عضو جدید
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="team-member">
                                    <img src="https://picsum.photos/seed/ceo/150/150" alt="CEO">
                                    <h6>علی رضایی</h6>
                                    <p class="text-muted mb-2">مدیرعامل</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="#" class="text-primary"><i class="fab fa-linkedin"></i></a>
                                        <a href="#" class="text-info"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="team-member">
                                    <img src="https://picsum.photos/seed/cto/150/150" alt="CTO">
                                    <h6>مریم احمدی</h6>
                                    <p class="text-muted mb-2">مدیر فنی</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="#" class="text-primary"><i class="fab fa-linkedin"></i></a>
                                        <a href="#" class="text-info"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="team-member">
                                    <img src="https://picsum.photos/seed/cfo/150/150" alt="CFO">
                                    <h6>رضا محمدی</h6>
                                    <p class="text-muted mb-2">مدیر مالی</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="#" class="text-primary"><i class="fab fa-linkedin"></i></a>
                                        <a href="#" class="text-info"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="team-member">
                                    <img src="https://picsum.photos/seed/hr/150/150" alt="HR">
                                    <h6>سارا حسینی</h6>
                                    <p class="text-muted mb-2">مدیر منابع انسانی</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="#" class="text-primary"><i class="fab fa-linkedin"></i></a>
                                        <a href="#" class="text-info"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Management Page -->
            <div id="projects-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">پروژه‌های شرکت</h5>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>افزودن پروژه جدید
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>نام پروژه</th>
                                        <th>مشتری</th>
                                        <th>تاریخ شروع</th>
                                        <th>تاریخ پایان</th>
                                        <th>وضعیت</th>
                                        <th>پیشرفت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>طراحی سایت شرکت الف</td>
                                        <td>شرکت الف</td>
                                        <td>1403/01/01</td>
                                        <td>1403/03/01</td>
                                        <td><span class="badge bg-primary">در حال انجام</span></td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" style="width: 65%;">65%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-info me-1"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>سیستم مدیریت محتوا</td>
                                        <td>شرکت ب</td>
                                        <td>1402/12/01</td>
                                        <td>1403/02/01</td>
                                        <td><span class="badge bg-success">تکمیل شده</span></td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;">100%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-info me-1"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Careers Management Page -->
            <div id="careers-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">فرصت‌های شغلی</h5>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>افزودن موقعیت شغلی
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>توسعه دهنده فرانت‌اند</h5>
                                        <p class="text-muted">دپارتمان فنی • تمام وقت</p>
                                        <p>ما به دنبال یک توسعه دهنده فرانت‌endir خلاق و با تجربه هستیم...</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">منتشر شده: 1403/01/10</small>
                                            <div>
                                                <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>کارشناس بازاریابی دیجیتال</h5>
                                        <p class="text-muted">دپارتمان بازاریابی • تمام وقت</p>
                                        <p>به دنبال یک کارشناس بازاریابی دیجیتال با سابقه کار مفید...</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">منتشر شده: 1403/01/05</small>
                                            <div>
                                                <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other pages (Pages, Users, Settings, Analytics, Media, Comments) remain similar to previous version -->
            <!-- Pages Management Page -->
            <div id="pages-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">مدیریت صفحات</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPageModal">
                            <i class="fas fa-plus me-2"></i>افزودن صفحه جدید
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>عنوان صفحه</th>
                                        <th>Slug</th>
                                        <th>تاریخ ایجاد</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>درباره ما</td>
                                        <td>/about-us</td>
                                        <td>1403/01/01</td>
                                        <td><span class="badge bg-success">منتشر شده</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-info me-1"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>تماس با ما</td>
                                        <td>/contact</td>
                                        <td>1403/01/05</td>
                                        <td><span class="badge bg-success">منتشر شده</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-info me-1"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Management Page -->
            <div id="users-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">مدیریت کاربران</h5>
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>افزودن کاربر جدید
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="جستجوی کاربر...">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>همه نقش‌ها</option>
                                    <option>مدیر</option>
                                    <option>کاربر عادی</option>
                                    <option>نویسنده</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>همه وضعیت‌ها</option>
                                    <option>فعال</option>
                                    <option>غیرفعال</option>
                                    <option>مسدود شده</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>نام کاربری</th>
                                        <th>ایمیل</th>
                                        <th>نقش</th>
                                        <th>تاریخ عضویت</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://picsum.photos/seed/user1/40/40" alt="User" class="rounded-circle me-2">
                                                <span>علی رضایی</span>
                                            </div>
                                        </td>
                                        <td>ali@example.com</td>
                                        <td><span class="badge bg-primary">مدیر</span></td>
                                        <td>1403/01/01</td>
                                        <td><span class="badge bg-success">فعال</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-warning me-1"><i class="fas fa-lock"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Page -->
            <div id="settings-page" class="page-content" style="display: none;">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">تنظیمات کلی سایت</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">نام شرکت</label>
                                        <input type="text" class="form-control" value="نام شرکت شما">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">توضیحات شرکت</label>
                                        <textarea class="form-control" rows="3">توضیحات متا شرکت در اینجا قرار می‌گیرد...</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">کلمات کلیدی</label>
                                        <input type="text" class="form-control" value="شرکت, خدمات, مشاوره">
                                        <small class="text-muted">کلمات کلیدی را با کاما از هم جدا کنید</small>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">ایمیل شرکت</label>
                                            <input type="email" class="form-control" value="info@company.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">شماره تماس</label>
                                            <input type="tel" class="form-control" value="021-12345678">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">لوگو شرکت</label>
                                        <input type="file" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">فاوآیکون</label>
                                        <input type="file" class="form-control" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-primary">ذخیره تنظیمات</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">تنظیمات SEO</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Google Analytics</label>
                                        <input type="text" class="form-control" placeholder="UA-XXXXXXXX-X">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Google Search Console</label>
                                        <input type="text" class="form-control" placeholder="کد تایید">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="seoEnabled" checked>
                                            <label class="form-check-label" for="seoEnabled">فعالسازی SEO</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="sitemapEnabled" checked>
                                            <label class="form-check-label" for="sitemapEnabled">تولید نقشه سایت</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Page -->
            <div id="analytics-page" class="page-content" style="display: none;">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">آمار و تحلیل سایت</h5>
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary btn-sm">امروز</button>
                                    <button class="btn btn-primary btn-sm">هفته</button>
                                    <button class="btn btn-outline-primary btn-sm">ماه</button>
                                    <button class="btn btn-outline-primary btn-sm">سال</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="analyticsChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">منابع ترافیک</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="sourceChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">دستگاه‌ها</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="deviceChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">مرورگرها</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="browserChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Management Page -->
            <div id="media-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">مدیریت رسانه</h5>
                        <div>
                            <button class="btn btn-primary me-2">
                                <i class="fas fa-upload me-2"></i>آپلود فایل
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-folder-plus me-2"></i>ایجاد پوشه
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" placeholder="جستجوی فایل‌ها...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>همه انواع</option>
                                    <option>تصاویر</option>
                                    <option>ویدئوها</option>
                                    <option>اسناد</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>مرتب‌سازی بر اساس تاریخ</option>
                                    <option>مرتب‌سازی بر اساس نام</option>
                                    <option>مرتب‌سازی بر اساس حجم</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3 col-sm-6">
                                <div class="card media-item">
                                    <img src="https://picsum.photos/seed/media1/300/200" class="card-img-top" alt="Media">
                                    <div class="card-body p-2">
                                        <small class="text-muted d-block">company-logo.jpg</small>
                                        <small class="text-muted">245 KB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card media-item">
                                    <img src="https://picsum.photos/seed/media2/300/200" class="card-img-top" alt="Media">
                                    <div class="card-body p-2">
                                        <small class="text-muted d-block">team-photo.jpg</small>
                                        <small class="text-muted">189 KB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Management Page -->
            <div id="comments-page" class="page-content" style="display: none;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">مدیریت نظرات</h5>
                        <div class="btn-group">
                            <button class="btn btn-outline-primary btn-sm">همه</button>
                            <button class="btn btn-warning btn-sm">در انتظار تایید</button>
                            <button class="btn btn-success btn-sm">تایید شده</button>
                            <button class="btn btn-danger btn-sm">اسپم</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="comment-item border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex">
                                    <img src="https://picsum.photos/seed/commenter1/50/50" alt="User" class="rounded-circle me-3">
                                    <div>
                                        <h6 class="mb-1">محمد حسینی</h6>
                                        <small class="text-muted">1403/01/15 - 14:30</small>
                                        <p class="mt-2 mb-1">خدمات شرکت شما واقعاً عالی بود. تیم حرفه‌ای و متخصص دارید.</p>
                                        <div class="mt-2">
                                            <span class="badge bg-warning me-2">در انتظار تایید</span>
                                            <small class="text-muted">در پاسخ به: صفحه خدمات</small>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-success me-1"><i class="fas fa-check"></i></button>
                                    <button class="btn btn-sm btn-danger me-1"><i class="fas fa-times"></i></button>
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-reply"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Message Modal -->
    <div class="modal fade" id="viewMessageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">مشاهده پیام</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>نام و نام خانوادگی:</strong> احمد محمدی
                        </div>
                        <div class="col-md-6">
                            <strong>شرکت:</strong> شرکت الف
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>ایمیل:</strong> ahmad@example.com
                        </div>
                        <div class="col-md-6">
                            <strong>موضوع:</strong> همکاری
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>تاریخ:</strong> 1403/01/15
                        </div>
                        <div class="col-md-6">
                            <strong>تلفن:</strong> 0912-345-6789
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>متن پیام:</strong>
                        <div class="border rounded p-3 mt-2 bg-light">
                            با سلام،<br>
                            در زمینه ارائه خدمات مشاوره فنی به شرکت شما علاقه‌مند هستیم. لطفاً جهت همکاری بیشتر با ما تماس بگیرید.<br>
                            با تشکر
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button type="button" class="btn btn-primary">پاسخ دادن</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Page Modal -->
    <div class="modal fade" id="addPageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">افزودن صفحه جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">عنوان صفحه</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" dir="ltr" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">محتوا</label>
                            <textarea class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pagePublished" checked>
                                <label class="form-check-label" for="pagePublished">منتشر شود</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary">ذخیره صفحه</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">افزودن خدمت جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">عنوان خدمت</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">توضیحات</label>
                            <textarea class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">آیکون</label>
                            <select class="form-select">
                                <option>fas fa-laptop-code</option>
                                <option>fas fa-chart-line</option>
                                <option>fas fa-shield-alt</option>
                                <option>fas fa-cloud</option>
                                <option>fas fa-cogs</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">رنگ آیکون</label>
                            <select class="form-select">
                                <option>text-primary</option>
                                <option>text-success</option>
                                <option>text-warning</option>
                                <option>text-danger</option>
                                <option>text-info</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary">ذخیره خدمت</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;
        const themeIcon = themeToggle.querySelector('i');

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            body.classList.add('dark-mode');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        }

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            const isDark = body.classList.contains('dark-mode');
            
            if (isDark) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
                localStorage.setItem('theme', 'light');
            }
        });

        // Sidebar Toggle (Mobile)
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Page Navigation
        const menuItems = document.querySelectorAll('.menu-item');
        const pageContents = document.querySelectorAll('.page-content');
        const pageTitle = document.getElementById('pageTitle');

        const pageTitles = {
            'dashboard': 'داشبورد',
            'header': 'مدیریت هدر',
            'footer': 'مدیریت فوتر',
            'contact': 'تماس با ما',
            'pages': 'مدیریت صفحات',
            'services': 'خدمات شرکت',
            'team': 'تیم مدیریت',
            'projects': 'پروژه‌ها',
            'careers': 'فرصت‌های شغلی',
            'users': 'مدیریت کاربران',
            'settings': 'تنظیمات سایت',
            'analytics': 'آمار و تحلیل',
            'media': 'مدیریت رسانه',
            'comments': 'مدیریت نظرات'
        };

        menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Remove active class from all menu items
                menuItems.forEach(mi => mi.classList.remove('active'));
                
                // Add active class to clicked item
                item.classList.add('active');
                
                // Hide all page contents
                pageContents.forEach(pc => pc.style.display = 'none');
                
                // Show selected page
                const pageId = item.getAttribute('data-page') + '-page';
                const selectedPage = document.getElementById(pageId);
                if (selectedPage) {
                    selectedPage.style.display = 'block';
                    pageTitle.textContent = pageTitles[item.getAttribute('data-page')];
                }
                
                // Close sidebar on mobile
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                }
            });
        });

        // Initialize Charts
        const isDarkMode = () => body.classList.contains('dark-mode');
        
        // Visit Chart
        const visitCtx = document.getElementById('visitChart');
        if (visitCtx) {
            new Chart(visitCtx, {
                type: 'line',
                data: {
                    labels: ['شنبه', 'یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'],
                    datasets: [{
                        label: 'بازدیدکنندگان',
                        data: [1200, 1900, 1500, 2100, 2400, 2200, 2800],
                        borderColor: '#1e40af',
                        backgroundColor: 'rgba(30, 64, 175, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: isDarkMode() ? '#4b5563' : '#e5e7eb'
                            },
                            ticks: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        },
                        x: {
                            grid: {
                                color: isDarkMode() ? '#4b5563' : '#e5e7eb'
                            },
                            ticks: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        }
                    }
                }
            });
        }

        // Traffic Chart
        const trafficCtx = document.getElementById('trafficChart');
        if (trafficCtx) {
            new Chart(trafficCtx, {
                type: 'doughnut',
                data: {
                    labels: ['مستقیم', 'جستجو', 'شبکه اجتماعی', 'ارجاع'],
                    datasets: [{
                        data: [35, 30, 20, 15],
                        backgroundColor: ['#1e40af', '#059669', '#d97706', '#dc2626']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        }
                    }
                }
            });
        }

        // Analytics Chart
        const analyticsCtx = document.getElementById('analyticsChart');
        if (analyticsCtx) {
            new Chart(analyticsCtx, {
                type: 'bar',
                data: {
                    labels: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور'],
                    datasets: [{
                        label: 'بازدید',
                        data: [45000, 52000, 48000, 61000, 58000, 67000],
                        backgroundColor: '#1e40af'
                    }, {
                        label: 'کاربران جدید',
                        data: [1200, 1500, 1300, 1800, 1600, 2100],
                        backgroundColor: '#059669'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: isDarkMode() ? '#4b5563' : '#e5e7eb'
                            },
                            ticks: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        },
                        x: {
                            grid: {
                                color: isDarkMode() ? '#4b5563' : '#e5e7eb'
                            },
                            ticks: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        }
                    }
                }
            });
        }

        // Source Chart
        const sourceCtx = document.getElementById('sourceChart');
        if (sourceCtx) {
            new Chart(sourceCtx, {
                type: 'pie',
                data: {
                    labels: ['گوگل', 'یاهو', 'بینگ', 'دیگر'],
                    datasets: [{
                        data: [65, 20, 10, 5],
                        backgroundColor: ['#1e40af', '#3b82f6', '#60a5fa', '#93bbfc']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        }
                    }
                }
            });
        }

        // Device Chart
        const deviceCtx = document.getElementById('deviceChart');
        if (deviceCtx) {
            new Chart(deviceCtx, {
                type: 'doughnut',
                data: {
                    labels: ['دسکتاپ', 'موبایل', 'تبلت'],
                    datasets: [{
                        data: [55, 35, 10],
                        backgroundColor: ['#059669', '#047857', '#065f46']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        }
                    }
                }
            });
        }

        // Browser Chart
        const browserCtx = document.getElementById('browserChart');
        if (browserCtx) {
            new Chart(browserCtx, {
                type: 'bar',
                data: {
                    labels: ['کروم', 'فایرفاکس', 'سافاری', 'اج'],
                    datasets: [{
                        label: 'درصد استفاده',
                        data: [65, 20, 10, 5],
                        backgroundColor: '#d97706'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: isDarkMode() ? '#4b5563' : '#e5e7eb'
                            },
                            ticks: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        },
                        x: {
                            grid: {
                                color: isDarkMode() ? '#4b5563' : '#e5e7eb'
                            },
                            ticks: {
                                color: isDarkMode() ? '#9ca3af' : '#6b7280'
                            }
                        }
                    }
                }
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Simulate real-time updates
        setInterval(() => {
            // Update random stat
            const statCards = document.querySelectorAll('.stat-card h3');
            if (statCards.length > 0) {
                const randomCard = statCards[Math.floor(Math.random() * statCards.length)];
                const currentValue = parseInt(randomCard.textContent.replace(/[^0-9]/g, ''));
                const newValue = currentValue + Math.floor(Math.random() * 10);
                randomCard.textContent = randomCard.textContent.replace(/[0-9]+/, newValue);
            }
        }, 5000);
    </script>
</body>
</html>