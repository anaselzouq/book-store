@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
<div class="container mt-5" style="direction: ltr;">
    <h1 class="text-center mt-2">Insert Book</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="title" class="mb-2">title</label>
            <input type="text" name="title" value="" class="form-control" id="title">
        </div>

        <div class="form-group mb-3">
            <label for="author" class="mb-2">author</label>
            <input type="text" name="author" value="" class="form-control" id="author">
        </div>

        <div class="form-group mb-3">
            <label for="description" class="mb-2">description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="published_date" class="mb-2">published_date</label>
            <input type="number" name="published_date" value="" class="form-control" id="published_date">
        </div>

        <div class="form-group mb-3">
            <label for="sub_category" class="mb-2">Sub_category</label>
            <input type="text" name="sub_category" value="" class="form-control" id="sub_category">
        </div>

        <div class="form-group mb-3">
            <label for="rating" class="mb-2">rating</label>
            <input type="text" name="rating" value="" class="form-control" id="rating">
        </div>

        <div class="form-group mb-3">
            <label for="price" class="mb-2">price</label>
            <input type="number" name="price" value="" class="form-control" id="price">
        </div>

        <div class="form-group mb-3">
            <label for="img" class="mb-2 d-block">image</label>
            <input type="file" name="img" id="img" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>

</html>
@endsection

