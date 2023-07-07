<?php

namespace App\Http\Livewire\Maintenance;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;

class Index extends Component
{

    public function maintenance($bool)
    {
        $filtered_bool = filter_var($bool, FILTER_VALIDATE_BOOLEAN);
        if($filtered_bool == true && $bool == 'true')
        {
            Artisan::call('down --secret="system:up"');
            setMaintenance();
            toastr("System is in Maintenance Mode!", "info");
        }else if($filtered_bool == false  && $bool == 'false'){
            Artisan::call('up');
            liftMaintenance();
            toastr("System is restored online!", "success");
        }else{
            toastr("Unknown error!", "error");
        }
    }

    public function render()
    {
        return view('livewire.maintenance.index')
        ->extends('livewire.components.master', ['title' => 'GAD - Maintenance'])
        ->section('contents');
    }
}
