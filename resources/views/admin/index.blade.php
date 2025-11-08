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
            background: linear-gradient(135deg, #059669, #047857);
        }

        .stat-card.warning {
            background: linear-gradient(135deg, #d97706, #b45309);
        }

        .stat-card.danger {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-building"></i> پنل مدیریت</h3>
        </div>
        <div class="sidebar-menu">
            <a href="index.html" class="menu-item active">
                <i class="fas fa-home"></i>
                <span>داشبورد</span>
            </a>
            <a href="header.html" class="menu-item">
                <i class="fas fa-header"></i>
                <span>مدیریت هدر</span>
            </a>
            <a href="footer.html" class="menu-item">
                <i class="fas fa-grip-lines"></i>
                <span>مدیریت فوتر</span>
            </a>
            <a href="contact.html" class="menu-item">
                <i class="fas fa-envelope"></i>
                <span>تماس با ما</span>
            </a>
            <a href="pages.html" class="menu-item">
                <i class="fas fa-file-alt"></i>
                <span>مدیریت صفحات</span>
            </a>
            <a href="services.html" class="menu-item">
                <i class="fas fa-concierge-bell"></i>
                <span>خدمات شرکت</span>
            </a>
            <a href="team.html" class="menu-item">
                <i class="fas fa-users"></i>
                <span>تیم مدیریت</span>
            </a>
            <a href="projects.html" class="menu-item">
                <i class="fas fa-project-diagram"></i>
                <span>پروژه‌ها</span>
            </a>
            <a href="careers.html" class="menu-item">
                <i class="fas fa-briefcase"></i>
                <span>فرصت‌های شغلی</span>
            </a>
            <a href="users.html" class="menu-item">
                <i class="fas fa-user-friends"></i>
                <span>مدیریت کاربران</span>
            </a>
            <a href="settings.html" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>تنظیمات سایت</span>
            </a>
            <a href="analytics.html" class="menu-item">
                <i class="fas fa-chart-line"></i>
                <span>آمار و تحلیل</span>
            </a>
            <a href="media.html" class="menu-item">
                <i class="fas fa-images"></i>
                <span>مدیریت رسانه</span>
            </a>
            <a href="comments.html" class="menu-item">
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
                <h4 class="mb-0 me-3">داشبورد</h4>
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

        <!-- Dashboard Content -->
        <div class="container-fluid p-4">
            <!-- Company Info -->
            <div class="company-info" style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 1.5rem;">
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
                            <a href="services.html" class="btn btn-sm btn-outline-primary">مشاهده همه</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="service-card" style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; transition: all 0.3s ease; height: 100%;">
                                        <i class="fas fa-laptop-code fa-2x text-primary mb-2"></i>
                                        <h6>مشاوره فنی</h6>
                                        <small class="text-muted">1,234 بازدید</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="service-card" style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; transition: all 0.3s ease; height: 100%;">
                                        <i class="fas fa-chart-line fa-2x text-success mb-2"></i>
                                        <h6>تحلیل کسب‌وکار</h6>
                                        <small class="text-muted">987 بازدید</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="service-card" style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; transition: all 0.3s ease; height: 100%;">
                                        <i class="fas fa-shield-alt fa-2x text-warning mb-2"></i>
                                        <h6>امنیت شبکه</h6>
                                        <small class="text-muted">876 بازدید</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="service-card" style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; transition: all 0.3s ease; height: 100%;">
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