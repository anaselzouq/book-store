@extends('layouts.footer')
@extends('layouts.nav')

@section('title', 'طلباتي')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm p-4 rounded">
        <h2 class="mb-4">طلباتي</h2>

        @if($orders->isEmpty())
            <div class="alert alert-info">لم تقم بأي طلب حتى الآن.</div>
        @else
            @foreach($orders as $order)
                <div class="mb-4 border-bottom pb-3">
                    <h5>طلب رقم #{{ $order->id }} - <small class="text-muted">{{ $order->created_at->format('Y-m-d') }}</small></h5>
                    <p class="mb-2">الإجمالي: <strong>{{ $order->total_price }} جنيه</strong></p>
                    <p class="mb-1">طريقة الدفع: {{ $order->payment_method === 'cod' ? 'الدفع عند الاستلام' : $order->payment_method }}</p>

                    <ul class="list-group mt-3">
                        @foreach($order->orderItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->book->title }}</strong>
                                    <div class="text-muted small">الكمية: {{ $item->quantity }}</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{ $item->price }} ج</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
