<div class="d-flex justify-content-center mb-4">
    <div class="position-relative input-group w-100 w-md-75 w-lg-50">
        <input type="text" wire:model.live.debounce.500ms="query" class="form-control form-control-lg"
            placeholder="ابحث عن الرواية أو المؤلف..." wire:keydown.enter="redirectToSearch">

        <button type="button" class="btn btn-warning btn-lg">
            <i class="fas fa-search"></i> بحث
        </button>

        @if ($query !== '')
            <div class="position-absolute bg-white rounded shadow mt-5 w-100" style="z-index:999">
                @if ($results->count())
                    @foreach ($results as $book)
                        <a href="{{ route('books.show', $book->id) }}" class="d-flex align-items-center px-3 py-2 hover:bg-light"
                            style="text-decoration:none">

                            <img src="{{ asset('uploads/' . $book->thumbnail) }}" width="40" height="60" class="me-2" alt="">

                            <div class="d-flex flex-column" style="overflow:hidden">
                                <span style="color:black;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 230px;text-align: right;">
                                    {{ $book->title }}
                                </span>
                                <small class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $book->author }}
                                </small>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="px-3 py-2 text-muted">لا توجد نتائج</div>
                @endif
            </div>
        @endif
    </div>
</div>
