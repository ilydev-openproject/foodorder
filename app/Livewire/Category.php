<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Category as ModelsCategory;

class Category extends Component
{
    public $activeCategorySlug;

    public function mount()
    {
        // Ambil slug kategori dari URL
        $this->activeCategorySlug = Request::segment(2); // /menu/{slug}, jadi slug ada di segment 2
    }

    public function render()
    {
        $categories = ModelsCategory::all();
        return view('livewire.category', compact('categories'));
    }
}
