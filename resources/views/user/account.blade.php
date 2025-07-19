@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-5">
                    <h3 class="mb-4 text-center fw-bold">
                        👤 حسابي
                    </h3>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5 class="fw-semibold">الاسم:</h5>
                        <p class="text-muted">{{ Auth::user()->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold">البريد الإلكتروني:</h5>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="d-flex flex-wrap gap-3 mt-4 justify-content-center">
                        <a href="{{ route('account.edit') }}" class="btn btn-outline-primary px-4">
                            ✏️ تعديل البيانات
                        </a>

                        <a href="{{ route('account.password') }}" class="btn btn-outline-warning px-4">
                            🔑 تغيير كلمة المرور
                        </a>

                        <a href="{{ route('user.orders') }}" class="btn btn-outline-success px-4">
                            📦 طلباتي
                        </a>

                        <a href="/cart" class="hover-btn-cart btn btn-outline-dark px-4 position-relative">
                            🛒 المشتريات
                            @php
                                use App\Models\Cart;
                                $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->sum('quantity') : 0;
                            @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
