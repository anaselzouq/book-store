<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>Register Account</title>
    @vite(['resources/js/app.js', 'resources/sass/style.scss'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-light">
    <div class="image">
        <a href="/"><img src="images/logo1.png" width="150" alt=""></a>
    </div>
    <div class="wrapper">
        <form method="POST" action="{{ url('/register') }}">
            @csrf

            <div class="mb-3 input-box">
                <input class="form-control" name="name" placeholder="الاسم" type="text" value="{{ old('name') }}">
                @error('name')
                <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 input-box">
                <input type="email" name="email" placeholder="البريد الإلكتروني" class="form-control" value="{{ old('email') }}">
                @error('email')
                <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3 input-box position-relative">
                <input type="password" name="password" placeholder="كلمة المرور" class="form-control" id="password">
                <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword('password', this)">
                    <i class="fa fa-eye"></i>
                </span>
                @error('password')
                <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 input-box position-relative">
                <input class="form-control" name="password_confirmation" type="password" placeholder="تأكيد كلمة المرور" id="password_confirmation">
                <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;"  onclick="togglePassword('password_confirmation', this)">
                    <i class="fa fa-eye"></i>
                </span>
            </div>


            <button type="submit" class="btun mt-3">أنشاء حساب</button>

            <div class="register-link">
                <p class="signin">لديك حساب بالفعل ? <a href="{{ url('/login') }}"> تسجيل الدخول </a></p>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(fieldId, iconElement) {
            const field = document.getElementById(fieldId);
            const icon = iconElement.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>
