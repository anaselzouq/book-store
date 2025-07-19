@extends('layouts.nav')

@section('content')
<div class="container text-center my-5">
    <h2 class="text-success mb-4">✅ شكراً لتأكيد طلبك!</h2>
    <p class="lead">تم استلام طلبك بنجاح وسيتم التواصل معك قريباً.</p>
    <a href="{{ route('books.index') }}" class="btn btn-primary mt-4" style="color: #fff !important;">العودة للتصفح</a>
</div>
@endsection
