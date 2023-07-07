<?php

namespace App\Http\Livewire\SettingWebicon;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SettingGeneral;

class Index extends Component
{
    use WithFileUploads;

    public $file, $setting;

    public function mount()
    {
        $this->setting = SettingGeneral::findOrFail(1);
    }

    public function upload()
    {
        $this->validate([
            'file' => 'image:max:2048'
        ]);

        $this->file->storeAs('public/media/', $this->file->getClientOriginalName());

        $this->setting->update([
            'web_icon' => 'media/'.$this->file->getClientOriginalName()
        ]);

        session([
            'webicon' => 'media/'.$this->file->getClientOriginalName()
        ]);


        unlink(storage_path('app/livewire-tmp/') . $this->file->getFilename());

        toastr('Web icon successfully updated');
        $this->dispatchBrowserEvent('reloadComponent');
    }

    public function render()
    {
        return view('livewire.setting-webicon.index')
        ->extends('livewire.components.master', ['title' => 'GAD - Setting Web Icon'])
        ->section('contents');
    }
}
