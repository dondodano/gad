<?php

namespace App\Http\Livewire\LogUser;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.log-user.index')
        ->extends('livewire.components.master', ['title' => 'GAD - Log User'])
        ->section('contents');
    }
}
