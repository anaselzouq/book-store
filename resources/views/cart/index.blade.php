@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
<div class="container my-5">

    <h2 class="mb-4 text-center fw-bold">🛒 سلة المشتريات</h2>

    @if($cartItems->count() > 0)
    <div class="table-responsive shadow rounded p-3 bg-white">

        <table class="table table-striped align-middle text-center mb-4">
            <thead class="table-dark">
                <tr>
                    <th>الصورة</th>
                    <th>العنوان</th>
                    <th>المؤلف</th>
                    <th>السعر</th>
                    <th>الكمية</th>
                    <th>الإجمالي</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalBeforeDiscount = 0;
                $totalAfterDiscount = 0;
                @endphp

                @foreach($cartItems as $cartItem)
                @php
                $book = $cartItem->book;
                $quantity = $cartItem->quantity;
                $discountPercent = 36;
                $priceAfterDiscount = round(($book->price + 50) * (1 - $discountPercent / 100));

                $totalBeforeDiscount += ($book->price * $quantity);
                $totalAfterDiscount += ($priceAfterDiscount * $quantity);
                @endphp
                <tr>
                    <td>
                        <img src="{{ asset('uploads/' . $book->thumbnail) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 80px;">
                    </td>
                    <td class="fw-semibold">{{ $book->title }}</td>
                    <td>{{ $book->author ?? '-' }}</td>
                    <td>
                        <span class="text-decoration-line-through text-muted">{{ number_format($book->price + 50, 2) }} ج.م</span><br>
                        <span class="text-success fw-bold">{{ number_format($priceAfterDiscount, 2) }} ج.م</span><br>
                        <small class="text-info">بعد خصم {{ $discountPercent }}%</small>
                    </td>
                    <td>
                        <form action="{{ url('/update-cart/' . $book->id) }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $quantity }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                            <button type="submit" class="btn btn-primary btn-sm">تحديث</button>
                        </form>
                    </td>
                    <td>{{ number_format($priceAfterDiscount * $quantity, 2) }} ج.م</td>
                    <td>
                        <form action="{{ url('/remove-from-cart/' . $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <form action="{{ url('/clear-cart') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">🗑️ تفريغ السلة</button>
            </form>

            <div class="text-end">
                <h5>المجموع قبل الخصم: <span class="text-muted">{{ number_format($totalBeforeDiscount, 2) }} ج.م</span></h5>
                <h4 class="fw-bold">المجموع بعد الخصم: {{ number_format($totalAfterDiscount, 2) }} ج.م</h4>
            </div>
        </div>

        <div class="text-center">
            <form action="{{ url('/checkout') }}" method="POST">
                @csrf
                <a href="{{ route('checkout.form') }}" style="color: #fff !important;" class="btn btn-success btn-lg px-5 py-3 fw-bold">
                    تأكيد عملية الشراء
                </a>
            </form>
        </div>

    </div>
    @else
    <div class="alert alert-info text-center fs-5">
        لا توجد كتب في السلة حالياً.
    </div>
    @endif
</div>

@endsection
