<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>بين السطور</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    {{-- Vite + SCSS + FontAwesome --}}
    @vite(['resources/js/app.js','resources/js/main.js', 'resources/sass/app.scss'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Mu4y+qRmE6cF7c9i9..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&display=swap" rel="stylesheet">
    <!-- Cairo font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <div id="cart-alert" class="alert-box" style="display: none;">
        <i class="fas fa-check-circle"></i> تم إضافة الكتاب إلى سلة المشتريات
    </div>

    <nav class="main-navbar">
        <div class="nav-right-search d-flex align-items-center">
            <div class="logo d-flex align-items-center">
                <a href="/"><img src="{{ asset('images/logo1.png') }}" class="me-3" width="60" height="60" alt=""></a>
                <a href="/">
                    <h1 class="m-0">بين السطور</h1>
                </a>
                <!-- Search -->
                <form method="GET" class="search-container d-flex align-items-center flex-grow-1 mx-3" action="{{ route('books.search') }}">
                    <div class="position-relative w-100">
                        <input type="text" name="q" class="form-control ps-5" placeholder="اسم الرواية ,اسم المؤلف..." value="{{ request('q') }}">
                        <button type="submit" class="btn p-0 border-0 bg-transparent position-absolute top-50 start-0 translate-middle-y ps-3">
                            <i class="fas fa-search text-muted"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="bars">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

        <!-- Left Links -->
        <div class="nav-left">
            <a href="/">الصفحة الرئيسية</a>
            <a href="/all-novels">جميع الروايات</a>
            <a href="/#shop">الفئات</a>
            <a href="/#contact">للتواصل</a>
            <div class="social d-flex align-items-center">
                <a href="https://www.facebook.com/profile.php?id=100088795863299" target="_blank" class="not me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/bookaboo.store/" target="_blank" class="not me-3"><i class="fab fa-instagram"></i></a>
                <a href="https://api.whatsapp.com/send/?phone=201234567890&text&type=phone_number&app_absent=0" target="_blank" class="not" class="me-2"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

        <!-- Right Actions + Social -->
         <div class="nav-right">
            @php
                use App\Models\Cart;

                $cartCount = Auth::check()
                    ? Cart::where('user_id', Auth::id())->sum('quantity')
                    : 0;
            @endphp

            <li class="ms-3 position-relative text-center" style="width: 60px;">
                <a href="/cart" class="d-inline-block position-relative" style="width: 100%;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" style="stroke:none !important"
                        fill="currentColor" viewBox="0 0 24 24">
                        <!--Boxicons v3.0 https://boxicons.com | License  https://docs.boxicons.com/free-->
                        <path
                            d="M10.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M17.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M8.82 15.77c.31.75 1.04 1.23 1.85 1.23h6.18c.79 0 1.51-.47 1.83-1.2l3.24-7.4c.14-.31.11-.67-.08-.95S21.34 7 21 7H7.33L5.92 3.62C5.76 3.25 5.4 3 5 3H2v2h2.33zM19.47 9l-2.62 6h-6.18l-2.5-6z">
                        </path>
                    </svg>
                    <span id="cart-count"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger {{ $cartCount == 0 ? 'd-none' : '' }}"
                        style="font-size: 0.75rem;">
                        {{ $cartCount }}
                        <span class="visually-hidden">عدد الكتب في السلة</span>
                    </span>
                    <div class="txt-span" style="display: block; margin-top: 5px;">المشتريات</div>
                </a>
            </li>

            @if(Auth::check() && Auth::user()->role === 'admin')

                <a href="{{ route('admin.books') }}" class="d-flex flex-column"><i
                        class="fa-solid fa-user-tie me-2"></i><span class="txt-span">Admin Panel</span></a>

                <a href="{{ route('admin.orders') }}" class="mt-2 d-flex flex-column align-items-center nav-link">
                    <i class="fas fa-clipboard-list fa-lg mb-2"></i>
                    <span class="txt-span">عرض الطلبات</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn logout-btn p-0 d-flex flex-column"><i
                            class="fas fa-sign-out-alt me-2 mb-1"></i><span class="txt-span">خروج</span></button>
                </form>
            @elseif(Auth::check())
                <div class="account">
                    <a class="me-2 d-flex flex-column" href="{{ route('my.account') }}"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" style="stroke: black !important;margin-right: 0 !important;"
                            class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg> <span class="txt-span">{{ Auth::user()->name }}</span></a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button style="margin-top: 7px" type="submit" class="btn logout-btn p-0 d-flex flex-column"><i
                            class="fas fa-sign-out-alt me-2 mb-1"></i><span class="txt-span">خروج</span></button>
                    </form>
                </div>
            @else
                <div class="else-acc" style="margin-top: 0.7rem">
                    <a href="{{ route('login') }}" class="d-flex flex-column"><i class="fas fa-sign-in-alt"></i><span
                            class="txt-span">تسجيل الدخول</span></a>
                    <a href="{{ route('register') }}" class="d-flex flex-column" style="row-gap: 9px"><i class="fas fa-user-plus"></i><span
                            class="txt-span">أنشاء حساب</span></a>
                </div>
            @endif



        </div>
    </nav>

    @yield('content');
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let barsIcon = document.querySelector(".bars i");
            let barsContainer = document.querySelector(".main-navbar");

            barsIcon.addEventListener("click", function() {
                barsIcon.classList.toggle("fa-bars");
                barsIcon.classList.toggle("fa-xmark");
                barsContainer.classList.toggle("active");
            });
        });
    </script>
