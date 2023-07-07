<?php

namespace App\Http\Livewire\Preliminary;

use Livewire\Component;
use App\Models\Category;
use App\Models\Preliminary;

class Edit extends Component
{
    public $category;
    public $pretext;
    public $context;
    public $sequence;
    public $preliminary;

    public function mount($id)
    {
        $this->preliminary = Preliminary::findOrFail($id);

        $this->category =  $this->preliminary->category_id;
        $this->pretext = $this->preliminary->pretext;
        $this->context = $this->preliminary->context;
    }

    public function update()
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

        $update = $this->preliminary->update([
            'category_id' => $this->category,
            'pretext' => $this->pretext,
            'context' => $this->context
        ]);

        if(!$update)
        {
            toastr("Unable to update preliminary!", "error");
            return ;
        }

        toastr("Preliminary successfully updated!", 'success');
    }

    public function render()
    {
        return view('livewire.preliminary.edit',[
            'categories' => Category::where('active',1)->get()
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - Edit Preliminary'])
        ->section('contents');
    }
}
