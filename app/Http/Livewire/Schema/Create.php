<?php

namespace App\Http\Livewire\Schema;

use App\Models\Schema;
use Livewire\Component;

class Create extends Component
{
    public $title, $definition;

    public function store()
    {
        if(strlen($this->title) == 0)
        {
            toastr("Please fill all required field!", "error");
            return ;
        }

        $store = Schema::firstOrCreate([
            'title' => $this->title,
            'definition' => $this->definition
        ]);
        $store->save();
        $this->reset();

        if(!$store)
        {
            toastr("Unable to saved schema!", "error");
            return ;
        }

        toastr("Schema successfully created!", 'success');

    }

    public function render()
    {
        return view('livewire.schema.create')
        ->extends('livewire.components.master', ['title' => 'GAD - Schema'])
        ->section('contents');
    }
}
