<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class Edit extends Component
{
    public $title, $category;

    public function mount($id)
    {
        $this->category = Category::findOrFail($id);

        $this->title = $this->category->title;
    }

    public function update()
    {
        if(strlen($this->title) == 0)
        {
            toastr("Please fill all required field!", "error");
            return ;
        }

        $update = $this->category->update([
            'title' => $this->title,
        ]);


        if(!$update)
        {
            toastr("Unable to update category!", "error");
            return ;
        }

        toastr("Category successfully updated!", 'success');
    }

    public function render()
    {
        return view('livewire.category.edit')
        ->extends('livewire.components.master', ['title' => 'GAD - Edit Category'])
        ->section('contents');
    }
}
