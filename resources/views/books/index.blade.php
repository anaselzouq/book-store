@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
<div class="container" style="direction: ltr;">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('admin.books') }}" class="d-flex mt-5">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by title..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary me-3">Search</button>
    </form>
    <a href="/insert-book" class="btn btn-primary mt-4" style="color: #fff !important;">Add Book</a>
    <table class="table mt-3 table-striped table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>published_date</th>
                <th>Sub_category</th>
                <th>rating</th>
                <th>price</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->description }}</td>
                <td>{{ $book->published_date }}</td>
                <td>{{ $book->sub_category }}</td>
                <td>{{ $book->rating }}</td>
                <td>ج.م. {{ $book->price }}</td>
                <td><img src="{{ asset('uploads/' . $book->thumbnail) }}" width="100" alt="Book Image"></td>
                <td> <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a></td>
                <td>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>
@endsection

