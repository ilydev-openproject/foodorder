<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu as ModelsMenu;

class MenuShow extends Component
{
    public $menus = [];

    protected $listeners = ['categorySelected' => 'updateMenu'];

    public function mount()
    {
        $this->menus = ModelsMenu::all();
    }

    public function updateMenu($id)
    {
        $this->menus = ($id === 'all')
            ? ModelsMenu::all()
            : ModelsMenu::where('category_id', $id)->get();
    }

    public function render()
    {
        return view('livewire.menu-show', [
            'menus' => $this->menus
        ]);
    }
}
