@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
<div class="container my-5">
    <h2 class="text-center fw-bold mb-4">📦 تأكيد الطلب</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('checkout.store') }}" method="POST" class="shadow p-4 rounded bg-white">
                @csrf

                <h5 class="text-danger mb-3">عنوان الشحن</h5>

                <div class="row">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="col-md-6 mb-3">
                        <input type="text" name="first_name" class="form-control" placeholder="الاسم الأول" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" name="last_name" class="form-control" placeholder="الاسم الأخير" required>
                    </div>
                    <div class="col-12 mb-3">
                        <input type="text" name="address" class="form-control" placeholder="العنوان" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <select name="governorate" class="form-control" required>
                            <option value="">اختر المحافظة</option>
                            @foreach(['القاهرة','الجيزة','الأسكندرية','الدقهلية','الشرقية','الغربية','المنوفية','البحيرة','الفيوم','كفر الشيخ','قنا','أسيوط','سوهاج','بني سويف','دمياط','الإسماعيلية','السويس','الأقصر','أسوان','شمال سيناء','جنوب سيناء','المنيا','مطروح','البحر الأحمر','الوادي الجديد'] as $gov)
                            <option value="{{ $gov }}">{{ $gov }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" name="city" class="form-control" placeholder="المدينة" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="tel" name="phone" class="form-control" placeholder="رقم الهاتف" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="tel" name="phone2" class="form-control" placeholder="رقم هاتف آخر (اختياري)">
                    </div>
                </div>

                <h5 class="text-danger mt-4 mb-3">طريقة الدفع</h5>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                    <label class="form-check-label" for="cod">الدفع عند الاستلام</label>
                </div>

                <h5 class="text-danger mt-4 mb-3">تعديل طلبك</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>المجموع قبل الخصم:</span>
                        <strong>{{ number_format($totalBeforeDiscount, 2) }} ج.م</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>المجموع بعد الخصم:</span>
                        <strong>{{ number_format($totalAfterDiscount, 2) }} ج.م</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>الشحن:</span>
                        <strong>مجاني</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-dark text-white">
                        <span>الإجمالي:</span>
                        <strong>{{ number_format($totalAfterDiscount, 2) }} ج.م</strong>
                    </li>
                </ul>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg px-5 fw-bold">إتمام الطلب</button>
                </div>

                <div class="text-center mt-4">
                    <small class="text-muted">إذا واجهتك أي مشكلة يمكنك التواصل مع:</small><br>
                    <a href="/customer-service" class="text-primary">خدمة العملاء</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
