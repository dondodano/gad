<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Auth extends Component
{
    public $title;
    public $style;

    public function render()
    {
        return view('livewire.components.auth');
    }
}
