<?php

namespace App\Http\Livewire\Layout;

use Livewire\Component;

class Navbar extends Component
{
    public $title;
    public $parent;
    public $parentRoute;
    public $page;

    public function mount($title = null, $parent = null, $parentRoute = null, $page = null)
    {
        $this->title = $title;
        $this->parent = $parent;
        $this->parentRoute = $parentRoute;
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.layout.navbar');
    }
}
