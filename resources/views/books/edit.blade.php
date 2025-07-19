@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
<div class="container mt-5" style="direction: ltr;">
    <h2 class="text-center mb-3">Edit Book</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}">
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $book->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Published Year</label>
            <input type="number" name="published_date" class="form-control" value="{{ $book->published_date }}">
        </div>

        <div class="mb-3">
            <label>Sub Category</label>
            <input type="text" name="sub_category" class="form-control" value="{{ $book->sub_category }}">
        </div>

        <div class="mb-3">
            <label>Rating</label>
            <input type="text" name="rating" class="form-control" value="{{ $book->rating }}">
        </div>

        <div class="mb-3">
            <label>price</label>
            <input type="text" name="price" class="form-control" value="{{ $book->price }}">
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="{{ asset('uploads/' . $book->thumbnail) }}" width="100">
        </div>

        <div class="mb-3">
            <label>Change Image</label>
            <input type="file" name="img" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
@endsection

