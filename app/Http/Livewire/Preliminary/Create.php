<?php

namespace App\Http\Livewire\Preliminary;

use Livewire\Component;
use App\Models\Category;
use App\Models\Preliminary;

class Create extends Component
{
    public $category;
    public $pretext;
    public $context;
    public $sequence;

    public function mount()
    {
        //$this->sequence = Preliminary::where('active',1)->count() + 1;
        $this->category = Category::where('active',1)->first()->id;
    }

    public function hydrate()
    {
        $this->sequence = Preliminary::where('active',1)->count() + 1;
        $this->category = Category::where('active',1)->first()->id;
    }

    public function store()
    {
        if(strlen($this->category) == 0)
        {
            toastr("Please select category!", "error");
            return ;
        }

        if(strlen($this->context) == 0)
        {
            toastr("Please fill context!", "error");
            return ;
        }

        $store = Preliminary::firstOrCreate([
            'sequence' => $this->sequence,
            'category_id' => $this->category,
            'pretext' => $this->pretext,
            'context' => $this->context
        ]);
        $store->save();
        //$this->reset();

        $this->context = null;

        if(!$store)
        {
            toastr("Unable to saved preliminary!", "error");
            return ;
        }

        toastr("Preliminary successfully created!", 'success');

    }

    public function render()
    {
        return view('livewire.preliminary.create',[
            'categories' => Category::where('active',1)->get()
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - Preliminary'])
        ->section('contents');
    }
}
