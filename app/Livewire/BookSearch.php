<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class BookSearch extends Component
{
    public $query = '';
    public $results = [];
    public $search = '';


    public function updatedQuery()
    {
        $search = mb_strtolower($this->query);

        if (trim($search) == '') {
            $this->results = [];
            return;
        }

        $this->results = Book::whereRaw('LOWER(title) LIKE ?', ["{$search}%"])
            ->orWhereRaw('LOWER(author) LIKE ?', ["{$search}%"])
            ->limit(5)
            ->get();
    }

    public function redirectToSearch()
{
    if (trim($this->query) !== '') {
        return redirect()->route('books.search', ['q' => $this->query]);
    }
}

    public function render()
    {
        return view('livewire.book-search');
    }
}
