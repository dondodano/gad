<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class Create extends Component
{
    public $title;

    public function store()
    {
        if(strlen($this->title) == 0)
        {
            toastr("Please fill all required field!", "error");
            return ;
        }

        $store = Category::firstOrCreate([
            'title' => $this->title,
        ]);
        $store->save();
        $this->reset();

        if(!$store)
        {
            toastr("Unable to saved category!", "error");
            return ;
        }

        toastr("Category successfully created!", 'success');
    }

    public function render()
    {
        return view('livewire.category.create')
        ->extends('livewire.components.master', ['title' => 'GAD - Category'])
        ->section('contents');
    }
}
