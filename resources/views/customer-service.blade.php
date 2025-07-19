@extends('layouts.nav')

@section('content')
<div class="container my-5">

    <h2 class="text-center fw-bold mb-4">خدمة العملاء</h2>

    <div class="text-center mb-4">
        <p class="fs-5">أيام العمل: من السبت إلى الخميس | من 10:00 ص إلى 10:00 م</p>
        <a href="https://wa.me/201158679633" target="_blank" style="color: #fff !important;" class="btn btn-success btn-lg">
            <i class="bi bi-whatsapp"></i> تواصل معنا على واتساب
        </a>
    </div>

</div>
@endsection

@section('footer')
<footer class="bg-dark text-white pt-4 pb-2 mt-5">
    <div class="container">
        <div class="row text-center text-md-start">

            <div class="col-md-4 mb-3">
                <h5>روابط سريعة</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">شروط وأحكام الاستخدام</a></li>
                    <li><a href="#" class="text-white text-decoration-none">سياسة الخصوصية</a></li>
                    <li><a href="#" class="text-white text-decoration-none">سياسة الإرجاع والاسترداد</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-3">
                <h5>روابط الدعم</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">اتصل بنا</a></li>
                    <li><a href="{{ route('customer.service') }}" class="text-white text-decoration-none">خدمة العملاء</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-3 text-md-end">
                <p>© جميع الحقوق محفوظة لـموقعك 2025</p>
            </div>
        </div>
    </div>
</footer>
@endsection
