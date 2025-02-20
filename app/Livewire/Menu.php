<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu as ModelsMenu;

class Menu extends Component
{
    public function render()
    {
        $menus = ModelsMenu::all();
        return view('livewire.menu', compact('menus'));
    }
}
