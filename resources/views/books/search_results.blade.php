@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center">نتائج البحث عن: "{{ $query }}"</h2>

    @if($books->count() > 0)
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('uploads/' . $book->thumbnail) }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">المؤلف: {{ $book->author }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary w-100">عرض التفاصيل</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">لا توجد نتائج تطابق البحث.</p>
    @endif
</div>
</body>

</html>
@endsection
