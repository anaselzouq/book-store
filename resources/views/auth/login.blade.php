<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/js/app.js', 'resources/sass/style.scss'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="image text-center mt-3">
        <a href="/"><img src="images/logo1.png" width="150" alt=""></a>
    </div>

    <div class="wrapper mt-4">
        <form method="POST" action="{{ url('/login') }}" class="container" style="max-width: 400px;">
            @csrf


            @if ($errors->has('login_error'))
            <div class="alert alert-danger text-center">{{ $errors->first('login_error') }}</div>
            @endif



            <div class="mb-3 input-box position-relative">
                <input type="email" name="email" placeholder="البريد الإلكتروني" class="form-control"
                    value="{{ old('email') }}">
                <i class="fa-solid fa-envelope position-absolute top-50 translate-middle-y"></i>
                @error('email')
                <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3 input-box position-relative">
                <input type="password" name="password" id="login_password" placeholder="كلمة المرور" class="form-control">
                <span
                    onclick="togglePassword('login_password', this)" style="cursor: pointer;">
                    <i class="fa fa-eye text-muted"></i>
                </span>
                @error('password')
                <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btun mt-3 btn btn-primary w-100">تسجيل الدخول</button>

            <div class="register-link text-center mt-3">
                <p> <a href="{{ url('/register') }}" class="btn btn-link p-0">انشاء حساب</a> ليس لديك حساب ؟</p>
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