<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب کاربری</title>
    
    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --text-color: #1e293b;
            --light-color: #f8fafc;
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text-color);
        }

        .glass-container {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            max-width: 420px;
            width: 100%;
            padding: 40px 30px;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h4 {
            font-weight: 700;
            font-size: 28px;
            color: white;
            margin-bottom: 10px;
        }

        .form-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
        }

        .login-card-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-card-logo i {
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .form-floating {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            padding: 14px 16px;
            height: auto;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.1);
            color: white;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-left: 8px;
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0 12px 12px 0;
            color: rgba(255, 255, 255, 0.7);
        }

        .password-toggle {
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px 0 rgba(99, 102, 241, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px 0 rgba(99, 102, 241, 0.5);
        }

        .form-check {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .form-check-input {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-left: 8px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .form-footer a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-footer a:hover {
            color: white;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
        }

        .invalid-feedback {
            font-size: 0.85rem;
            color: #f87171;
            margin-top: 0.25rem;
        }

        .alert-danger {
            background: rgba(248, 113, 113, 0.2);
            border: 1px solid rgba(248, 113, 113, 0.3);
            color: white;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .alert-danger .btn-close {
            filter: invert(1);
        }

        @media (max-width: 576px) {
            .glass-container {
                padding: 30px 20px;
            }
            
            .form-header h4 {
                font-size: 24px;
            }
            
            .form-header p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="glass-container">
        <div class="form-header">
            <h4>ورود به سیستم</h4>
            <h4>Roshd Chat</h4>
            <p>لطفاً اطلاعات خود را وارد کنید</p>
        </div>
        
        <div class="login-card-logo">
            <i class="bi bi-person-circle"></i>
        </div>

        {{-- نمایش ارورهای احراز هویت --}}
        @if (session('status'))
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label">
                    <i class="bi bi-envelope"></i> ایمیل
                </label>
                <input type="email" name="email" id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="example@domain.com" 
                    required autofocus value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label">
                    <i class="bi bi-lock"></i> رمز عبور
                </label>
                <div class="input-group">
                    <input type="password" name="password" id="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        required>
                    <span class="input-group-text password-toggle" onclick="togglePassword()">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </span>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember" 
                    class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="form-check-label">مرا به خاطر بسپار</label>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-left ms-2"></i> ورود به حساب
            </button>
        </form>

        <div class="form-footer">
            <div>
                <a href="{{ route('password.request') }}">فراموشی رمز عبور؟</a>
            </div>
            <div>
                حساب ندارید؟ <a href="{{ route('register') }}">ثبت نام</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission animation
            const loginForm = document.querySelector('form');
            const submitBtn = document.querySelector('.btn-primary');
            
            loginForm.addEventListener('submit', function(e) {
                // Button animation
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> در حال ورود...';
                submitBtn.disabled = true;
                
                // Re-enable after a timeout if form submission takes too long
                setTimeout(() => {
                    if (submitBtn.disabled) {
                        submitBtn.innerHTML = '<i class="bi bi-box-arrow-in-left ms-2"></i> ورود به حساب';
                        submitBtn.disabled = false;
                    }
                }, 5000);
            });
            
            // Input focus effects
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>