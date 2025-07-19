@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 fw-bold text-center">📦 جميع الطلبات</h2>

    @if($orders->count() > 0)
    <div class="table-responsive bg-white shadow rounded p-3">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>اسم العميل</th>
                    <th>رقم الهاتف</th>
                    <th>العنوان</th>
                    <th>طريقة الدفع</th>
                    <th>المجموع</th>
                    <th>الكتب المطلوبة</th>
                    <th>تاريخ الطلب</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->city }} - {{ $order->governorate }} - {{ $order->address }}</td>
                        <td>{{ $order->payment_method == 'cod' ? 'الدفع عند الاستلام' : $order->payment_method }}</td>
                        <td>{{ number_format($order->total_price, 2) }} ج.م</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($order->orderItems as $item)
                                    <li>
                                        {{ $item->book->title }} × {{ $item->quantity }}
                                        - {{ number_format($item->price, 2) }} ج.م
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info text-center">لا توجد طلبات حتى الآن.</div>
    @endif
</div>
@endsection


