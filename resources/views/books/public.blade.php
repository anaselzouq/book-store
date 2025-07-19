<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>بين السطور</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}">
    {{-- Vite + SCSS + FontAwesome --}}
    @vite(['resources/js/app.js','resources/js/main.js', 'resources/sass/app.scss'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Mu4y+qRmE6cF7c9i9..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&display=swap" rel="stylesheet">
    <!-- Cairo font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div id="cart-alert" class="alert-box" style="display: none;">
        <i class="fas fa-check-circle"></i> تم إضافة الكتاب إلى سلة المشتريات
    </div>

    <nav class="main-navbar">
        <div class="nav-right-search d-flex align-items-center">
            <div class="logo d-flex align-items-center">
                <a href="/"><img src="images/logo1.png" class="me-3" width="60" height="60" alt=""></a>
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
                        <path d="M10.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M17.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M8.82 15.77c.31.75 1.04 1.23 1.85 1.23h6.18c.79 0 1.51-.47 1.83-1.2l3.24-7.4c.14-.31.11-.67-.08-.95S21.34 7 21 7H7.33L5.92 3.62C5.76 3.25 5.4 3 5 3H2v2h2.33zM19.47 9l-2.62 6h-6.18l-2.5-6z"></path>
                    </svg>
                    <span id="cart-count"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger {{ $cartCount == 0 ? 'd-none' : '' }}"
                        style="font-size: 0.75rem;">
                        {{ $cartCount }}
                        <span class="visually-hidden">عدد الكتب في السلة</span>
                    </span>
                    <div class="txt-span" style="display: block; font-size: 0.75rem; margin-top: 4px;">المشتريات</div>
                </a>
            </li>

            @if(Auth::check() && Auth::user()->role === 'admin')

            <a href="{{ route('admin.books') }}" class="d-flex flex-column"><i class="fa-solid fa-user-tie me-2"></i><span class="txt-span">Admin Panel</span></a>

            <a href="{{ route('admin.orders') }}" class="mt-2 d-flex flex-column align-items-center nav-link">
                <i class="fas fa-clipboard-list fa-lg mb-2"></i>
                <span class="txt-span">عرض الطلبات</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn logout-btn p-0 d-flex flex-column"><i class="fas fa-sign-out-alt me-2 mb-1"></i><span class="txt-span">خروج</span></button>
            </form>
            @elseif(Auth::check())
            <div class="account">
                <a class="me-2 d-flex flex-column" href="{{ route('my.account') }}"><i class="fa-regular fa-user"></i> <span class="txt-span">{{ Auth::user()->name }}</span></a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn logout-btn p-0 d-flex flex-column"><i class="fas fa-sign-out-alt me-2"></i><span class="txt-span">خروج</span></button>
                </form>
            </div>
            @else
            <a href="{{ route('login') }}" class="d-flex flex-column"><i class="fas fa-sign-in-alt"></i><span class="txt-span">تسجيل الدخول</span></a>
            <a href="{{ route('register') }}" class="d-flex flex-column"><i class="fas fa-user-plus"></i><span class="txt-span">أنشاء حساب</span></a>
            @endif



        </div>
    </nav>
    <!-- Hero Section Slider -->
    <section class="hero-section mb-5 position-relative text-center text-white d-flex align-items-center" style="flex-direction: column;justify-content: center;">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5);"></div>
        @if(session('success'))
        <div id="success-alert" class="alert alert-success text-center">
            {{ session('success') }}
        </div>
        @endif

        <div class="container position-relative z-1">
            <h1 class="mb-4 display-4 fw-bold">أشهر الروايات العربية بين يديك</h1>
            <form method="GET" class="d-flex justify-content-center mb-4" action="{{ route('books.search') }}">
                <div class="input-group w-100 w-md-75 w-lg-50">
                    <input type="text" name="q" class="form-control form-control-lg" placeholder="ابحث عن الرواية أو المؤلف..." value="{{ request('q') }}">
                    <button class="btn btn-warning btn-lg" type="submit"><i class="fas fa-search"></i> بحث</button>
                </div>
            </form>
        </div>
        <div>
            @if(session('not_found'))
            <div class="alert alert-warning text-center mt-3">
                {{ session('not_found') }}
            </div>
            @endif
        </div>
    </section>

    <section class="text-center mb-5" style="margin-top: 6rem">
        <h1 class="mt-5">أهلاً بك في عالم الروايات</h1>
        <p class="mt-3">
            مساحتك الخاصة للقصص المهمة. انغمس في مجموعة مختارة من <br> الروايات العربية والمترجمة، ودع كل صفحة تُحرك مشاعرك.
        </p>
    </section>

    <!-- Shop Section By Categories -->
    <section class="shop mb-5" id="shop" style="margin-top: 5rem;">
        <div class="container">
            <h1 class="mb-4 text-center">تصنيفات الروايات</h1>

            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">

                <div class="col text-center">
                    <a href="/romantic">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-heart fa-2x mb-3 text-danger"></i>
                                <h5 class="card-title">رومانسية</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col text-center">
                    <a href="/imagination">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-robot fa-2x mb-3 text-primary"></i>
                                <h5 class="card-title">خيال علمي</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col text-center">
                    <a href="/fantasy">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-hat-wizard fa-2x mb-3 text-purple"></i>
                                <h5 class="card-title">فانتازيا</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col text-center">
                    <a href="/horror">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-ghost fa-2x mb-3 text-dark"></i>
                                <h5 class="card-title">رعب</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col text-center">
                    <a href="/suspense">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-user-secret fa-2x mb-3 text-warning"></i>
                                <h5 class="card-title">تشويق وإثارة</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col text-center">
                    <a href="/crime">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-magnifying-glass fa-2x mb-3 text-info"></i>
                                <h5 class="card-title">بوليسية / جريمة</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col text-center">
                    <a href="/social">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-people-group fa-2x mb-3 text-success"></i>
                                <h5 class="card-title">اجتماعية</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col text-center">
                    <a href="/historical">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-landmark fa-2x mb-3 text-secondary"></i>
                                <h5 class="card-title">تاريخية</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col text-center">
                    <a href="/dramatic">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-masks-theater fa-2x mb-3 text-muted"></i>
                                <h5 class="card-title">دراما</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col text-center">
                    <a href="/subjective">
                        <div class="card h-100 shadow-sm py-4 category-card">
                            <div class="card-body">
                                <i class="fas fa-book-open fa-2x mb-3 text-primary"></i>
                                <h5 class="card-title">سيرة ذاتية / واقعية</h5>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- الكتب -->
    <section class="books">
        <div class="container-lg">
            <div class="row mb-5">
                <a href="/romantic" class="mb-2">
                    <h2 class="d-flex align-items-center">
                        الروايات الرومانسية
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'رومانسية')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
            <div class="row mt-5 mb-5">
                <a href="/imagination" class=" mb-2">
                    <h2 class="d-flex align-items-center">
                        خيال ومغامرة
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'خيال')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
            <div class="row mt-5 mb-5">
                <a href="/fantasy" class="mb-2">
                    <h2 class="d-flex align-items-center">
                        فانتزيا
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'فانتزيا')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
            <div class="row mt-5 mb-5">
                <a href="/horror" class="mb-2">
                    <h2 class="d-flex align-items-center">
                        رعب وغموض
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'رعب')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
            <div class="row mt-5 mb-5">
                <a href="/suspense" class="mb-2">
                    <h2 class="d-flex align-items-center">
                        تشويق وإثارة
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'تشويق')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
            <div class="row mt-5 mb-5">
                <a href="/crime" class="mb-2">
                    <h2 class="d-flex align-items-center">
                        بوليسية / جريمة
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'جريمة')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
            <div class="row mt-5 mb-5">
                <a href="/social" class="mb-2">
                    <h2 class="d-flex align-items-center">
                        اجتماعية
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'اجتماعية')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
            <div class="row mt-5 mb-5">
                <a href="/historical" class="mb-2">
                    <h2 class="d-flex align-items-center">
                        تاريخية
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'تاريخي')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
            <div class="row mt-5 mb-5">
                <a href="/dramatic" class="mb-2">
                    <h2 class="d-flex align-items-center">
                        دراما
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'دراما')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
            <div class="row mt-5 mb-5">
                <a href="/dramatic" class="mb-2">
                    <h2 class="d-flex align-items-center">
                        سيرة ذاتية / واقعية
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </h2>
                </a>
                @php $count = 0; @endphp
                @foreach ($books as $book)
                @if ($book->sub_category == 'ذاتية')
                @php $count++; @endphp
                <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="img">
                        <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                    </div>
                    <div class="content">
                        <div class="text p-3">
                            <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                            <p class="text-center">{{ $book->author }}</p>
                        </div>
                        <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                            <span class="new-price">{{ $book->price }} ج.م</span>
                        </div>
                    </div>
                </div>
                @if ($count == 5)
                @break
                @endif
                @endif
                @endforeach
            </div>
        </div>
    </section>

    <section id="contact" style="scroll-margin-top: 4rem !important;" class="py-5 bg-white border-top">
        <div class="container">
            <h2 class="text-center mb-4">تواصل معنا</h2>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <input type="text" name="name" placeholder="الاسم" required class="form-control mb-2">
                        <input type="email" name="email" style="direction: rtl;" placeholder="البريد الإلكتروني" required class="form-control mb-2">
                        <textarea name="message" placeholder="رسالتك" required class="form-control mb-2" style="    height: 208px;resize: none;"></textarea>
                        <button type="submit" class="btn btn-primary">إرسال</button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-5">
                <p>أو تواصل معنا عبر وسائل التواصل:</p>
                <div class="d-flex justify-content-center gap-4 fs-4">
                    <a href="https://www.facebook.com/profile.php?id=100088795863299" target="_blank" class="text-primary"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/bookaboo.store/" target="_blank" class="text-danger"><i class="fab fa-instagram"></i></a>
                    <a href="https://api.whatsapp.com/send/?phone=201234567890&text&type=phone_number&app_absent=0" target="_blank" class="text-success"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

    </section>

    @extends('layouts.footer')


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            }
        });
    </script>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>

</html>
