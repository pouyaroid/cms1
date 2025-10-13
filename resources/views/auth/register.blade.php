<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت‌نام</title>
    
    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --success-color: #e864fa;
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

        .password-input-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: rgba(255, 255, 255, 0.7);
            z-index: 5;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: rgba(255, 255, 255, 0.9);
        }

        .form-text {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 5px;
        }

        .register-btn {
            background: linear-gradient(45deg, var(--success-color), #6016ff);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px 0 rgba(16, 185, 129, 0.4);
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px 0 rgba(16, 185, 129, 0.5);
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

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .login-link a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: white;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
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
            <h4>ثبت نام</h4>
            <h4>Roshd Chat</h4>
            <p>ایجاد حساب کاربری جدید</p>
        </div>

        {{-- نمایش ارورهای احراز هویت --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">
                    <i class="fas fa-user"></i> نام
                </label>
                <input type="text" name="name" id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="نام کامل" 
                    required value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> ایمیل
                </label>
                <input type="email" name="email" id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="example@domain.com" 
                    required value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="fas fa-lock"></i> رمز عبور
                </label>
                <div class="password-input-group">
                    <input type="password" name="password" id="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        required>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>
                <small class="form-text">حداقل ۸ کاراکتر، شامل حروف بزرگ، کوچک و اعداد.</small>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">
                    <i class="fas fa-lock"></i> تکرار رمز عبور
                </label>
                <div class="password-input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        required>
                    <i class="fas fa-eye password-toggle" id="togglePasswordConfirmation"></i>
                </div>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn register-btn">
                <i class="fas fa-user-plus ms-2"></i> ثبت‌نام
            </button>
        </form>

        <div class="login-link">
            قبلاً حساب کاربری دارید؟ <a href="{{ route('login') }}">ورود</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // نمایش/مخفی کردن رمز عبور
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // نمایش/مخفی کردن تکرار رمز عبور
        document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const icon = this;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Form submission animation
            const registerForm = document.querySelector('form');
            const submitBtn = document.querySelector('.register-btn');
            
            registerForm.addEventListener('submit', function(e) {
                // Button animation
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> در حال ثبت‌نام...';
                submitBtn.disabled = true;
                
                // Re-enable after a timeout if form submission takes too long
                setTimeout(() => {
                    if (submitBtn.disabled) {
                        submitBtn.innerHTML = '<i class="fas fa-user-plus ms-2"></i> ثبت‌نام';
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