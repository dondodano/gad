<?php

namespace App\Http\Livewire\LogActivity;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.log-activity.index')
        ->extends('livewire.components.master', ['title' => 'GAD - Log Activity'])
        ->section('contents');
    }
}
