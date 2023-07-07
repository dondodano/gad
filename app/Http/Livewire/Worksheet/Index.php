<?php

namespace App\Http\Livewire\Worksheet;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.worksheet.index')
        ->extends('livewire.components.master', ['title' => 'GAD - Worksheet'])
        ->section('contents');
    }
}
