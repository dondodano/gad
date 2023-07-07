<?php

namespace App\Http\Livewire\SettingGeneral;

use Livewire\Component;
use App\Models\SettingGeneral;

class Index extends Component
{
    public $site_title, $site_definition, $entity_name, $entity_definition, $query;

    public function mount()
    {
        $this->query = SettingGeneral::findOrFail(1);


        $this->site_title = $this->query->site_title;
        $this->site_definition = $this->query->site_definition;
        $this->entity_name = $this->query->entity_name;
        $this->entity_definition = $this->query->entity_definition;
    }

    public function update()
    {
        if(strlen($this->site_title) == 0 || strlen($this->site_definition) == 0 || strlen($this->entity_name) == 0 || strlen($this->entity_definition) == 0 )
        {
            toastr("Please fill all required field!", "error");
            return ;
        }

        $update = $this->query->update([
            'site_title' =>  $this->site_title,
            'site_definition' =>  $this->site_definition,
            'entity_name' =>  $this->entity_name,
            'entity_definition' =>  $this->entity_definition,
        ]);

        if(!$update)
        {
            toastr("Unable to update General Setting!", "error");
            return ;
        }

        toastr("General setting successfully updated!", 'success');
    }

    public function render()
    {
        return view('livewire.setting-general.index')
        ->extends('livewire.components.master', ['title' => 'GAD - Setting General'])
        ->section('contents');
    }
}
