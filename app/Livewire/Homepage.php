<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use App\Models\Category;

class Homepage extends Component
{
    public $categories = [];
    public $selectedCategory = 'all';
    public $menus = [];

    // Tangkap event dari komponen kategori
    protected $listeners = ['categorySelected' => 'filterMenu'];

    public function mount()
    {
        // Ambil semua kategori dalam bentuk array agar lebih ringan
        $this->categories = Category::all();

        // Ambil semua menu (default)
        $this->menus = Menu::all();
    }

    public function filterMenu($id)
    {
        $this->selectedCategory = $id;

        if ($id === 'all') {
            $this->menus = Menu::all();
        } else {
            $this->menus = Menu::where('category_id', $id)->get();
        }
    }
    

    public function render()
    {
        return view('livewire.homepage', [
            'categories' => $this->categories,
            'menus' => $this->menus,
            'selectedCategory' => $this->selectedCategory,
        ]);
    }
}
