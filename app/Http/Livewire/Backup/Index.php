<?php

namespace App\Http\Livewire\Backup;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    public function mount()
    {
        if(!Storage::exists('/public/backups/'))
        {
            Storage::makeDirectory( '/public/backups/');
        }
    }

    public function backup()
    {
        Artisan::call('backup:run --only-files --disable-notifications');
        toastr('Backup created!');
        $this->all;
    }

    public function delete($file)
    {
        $file_path = 'backups/' . decipher($file);


        if(!Storage::disk('local')->exists($file_path))
        {
            toastr("File does not exist!", "error");
            return;
        }

        if(Storage::delete($file_path) == 1)
        {
            if(Storage::disk('public')->exists($file_path))
            {
                Storage::disk('public')->delete($file_path);
            }
            toastr("File <strong>[".decipher($file)."]</strong> successfully deleted!", "success");
            $this->all;
        }

    }

    public function download($file)
    {
        $filePath = 'backups/' . decipher($file);
        if(!Storage::disk('public')->exists($filePath))
        {
            $copy = Storage::copy($filePath, 'public/' . $filePath);
            if($copy)
            {
                return Storage::download('public/'. $filePath);
            }
        }

        return Storage::download('public/'. $filePath);
    }

    public function getAllProperty()
    {
        $files = []; $fileExtension = 'zip';
        $scan_files = scandir(storage_path('app/public/backups/'));

        foreach($scan_files as $file)
        {
            if(!is_dir($file))
            {
                $get = pathinfo($file);
                if($get['extension'] == $fileExtension)
                {
                    array_push($files, [
                        'filename' => $file,
                        'location' => storage_path('app/public/backups/'). $file
                    ]);
                }
            }
        }

        return $files;
    }

    public function render()
    {
        return view('livewire.backup.index',[
            'files' => $this->all
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - Backup System'])
        ->section('contents');
    }
}
