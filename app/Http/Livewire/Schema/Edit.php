<?php

namespace App\Http\Livewire\Schema;

use App\Models\Schema;
use Livewire\Component;

class Edit extends Component
{
    public $title, $definition, $schema;

    public function mount($id)
    {
        $this->schema = Schema::findOrFail($id);

        $this->title = $this->schema->title;
        $this->definition = $this->schema->definition;
    }

    public function update()
    {
        if(strlen($this->title) == 0)
        {
            toastr("Please fill all required field!", "error");
            return ;
        }

        $update = $this->schema->update([
            'title' => $this->title,
            'definition' => $this->definition,
        ]);

        if(!$update)
        {
            toastr("Unable to update schema!", "error");
            return ;
        }

        toastr("Schema successfully updated!", 'success');

    }

    public function render()
    {
        return view('livewire.schema.edit')
        ->extends('livewire.components.master', ['title' => 'GAD - Edit Schema'])
        ->section('contents');
    }
}
