<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/auth.css')}}">
</head>
<body>
    {{-- <div class="language-switcher">
        <button class="lang-btn" onclick="toggleLanguage()">
            <i class="fas fa-globe"></i> <span id="langText">العربية</span>
        </button>
    </div> --}}

    <div class="container">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h2 id="title">Create Account</h2>
                    <p id="subtitle">Sign up to get started</p>
                </div>

                <form id="registerForm">
                    <div class="mb-3">
                        <label for="fullName" class="form-label" id="nameLabel">Full Name</label>
                        <input type="text" class="form-control" id="fullName" placeholder="John Doe" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label" id="emailLabel">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="john@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label" id="passwordLabel">Password</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label" id="confirmLabel">Confirm Password</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="confirmPassword" placeholder="••••••••" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('confirmPassword')"></i>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms" id="termsLabel">
                            I agree to the Terms and Conditions
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitBtn">Create Account</button>
                </form>

                <div class="auth-link">
                    <span id="hasAccount">Already have an account?</span>
                    <a href="{{route('login')}}" id="loginLink">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const translations = {
            en: {
                langText: 'العربية',
                title: 'Create Account',
                subtitle: 'Sign up to get started',
                nameLabel: 'Full Name',
                namePlaceholder: 'John Doe',
                emailLabel: 'Email Address',
                emailPlaceholder: 'john@example.com',
                passwordLabel: 'Password',
                confirmLabel: 'Confirm Password',
                passwordPlaceholder: '••••••••',
                termsLabel: 'I agree to the Terms and Conditions',
                submitBtn: 'Create Account',
                hasAccount: 'Already have an account?',
                loginLink: 'Sign In'
            },
            ar: {
                langText: 'English',
                title: 'إنشاء حساب',
                subtitle: 'سجل للبدء',
                nameLabel: 'الاسم الكامل',
                namePlaceholder: 'أحمد محمد',
                emailLabel: 'البريد الإلكتروني',
                emailPlaceholder: 'ahmed@example.com',
                passwordLabel: 'كلمة المرور',
                confirmLabel: 'تأكيد كلمة المرور',
                passwordPlaceholder: '••••••••',
                termsLabel: 'أوافق على الشروط والأحكام',
                submitBtn: 'إنشاء حساب',
                hasAccount: 'لديك حساب بالفعل؟',
                loginLink: 'تسجيل الدخول'
            }
        };

        let currentLang = 'en';

        function toggleLanguage() {
            currentLang = currentLang === 'en' ? 'ar' : 'en';
            const html = document.documentElement;
            html.setAttribute('lang', currentLang);
            html.setAttribute('dir', currentLang === 'ar' ? 'rtl' : 'ltr');

            const t = translations[currentLang];
            document.getElementById('langText').textContent = t.langText;
            document.getElementById('title').textContent = t.title;
            document.getElementById('subtitle').textContent = t.subtitle;
            document.getElementById('nameLabel').textContent = t.nameLabel;
            document.getElementById('fullName').placeholder = t.namePlaceholder;
            document.getElementById('emailLabel').textContent = t.emailLabel;
            document.getElementById('email').placeholder = t.emailPlaceholder;
            document.getElementById('passwordLabel').textContent = t.passwordLabel;
            document.getElementById('confirmLabel').textContent = t.confirmLabel;
            document.getElementById('password').placeholder = t.passwordPlaceholder;
            document.getElementById('confirmPassword').placeholder = t.passwordPlaceholder;
            document.getElementById('termsLabel').textContent = t.termsLabel;
            document.getElementById('submitBtn').textContent = t.submitBtn;
            document.getElementById('hasAccount').textContent = t.hasAccount;
            document.getElementById('loginLink').textContent = t.loginLink;
        }

        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling;

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert(currentLang === 'en' ? 'Passwords do not match!' : 'كلمات المرور غير متطابقة!');
                return;
            }

            alert(currentLang === 'en' ? 'Registration successful!' : 'تم التسجيل بنجاح!');
        });
    </script>
</body>
</html>
