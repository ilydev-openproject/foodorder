<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category as ModelsCategory;

class CategoryFilter extends Component
{
    public $categories = [];
    public $selectedCategory = 'all';

    public function mount()
    {
        $this->categories = ModelsCategory::all();
    }

    public function selectCategory($id)
    {
        $this->selectedCategory = $id;
        $this->dispatch('categorySelected', $id);
    }

    public function render()
    {
        return view('livewire.category-filter');
    }
}
