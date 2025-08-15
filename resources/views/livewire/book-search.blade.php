<div class="position-relative w-100 ms-4">
    <input wire:model.live.debounce.500ms='search' type="text" wire:model.debounce.500ms="query"
        class="form-control ps-5" placeholder="اسم الرواية ,اسم المؤلف..." wire:keydown.enter="redirectToSearch">

    @if ($query !== '')
        <div class="position-absolute w-100 bg-white rounded shadow mt-1" style="z-index: 999">
            @if ($results->count())
                @foreach ($results as $book)
                    <a href="{{ route('books.show', $book->id) }}" class="d-flex align-items-center px-3 py-2 hover:bg-light"
                        style="text-decoration:none">

                        <img src="{{ asset('uploads/' . $book->thumbnail) }}" alt="" width="40" height="60" class="me-2">

                        <div class="d-flex flex-column" style="overflow:hidden">
                            <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 230px;">
                                {{ $book->title }}
                            </span>
                            <small class="text-muted"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 230px;">
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


