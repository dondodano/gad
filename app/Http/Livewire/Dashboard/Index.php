<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use App\Models\Schema;
use Livewire\Component;
use App\Models\UserRole;
use App\Models\UserTempAvatar;
use Illuminate\Support\Facades\Artisan;

class Index extends Component
{

    /**
     * Quick Backup
     */
    public function getBackupListProperty()
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

    public function quickBackup()
    {
        Artisan::call('backup:run --only-files --disable-notifications');
        toastr('Backup created!');

        $this->backupList;
    }


    /**
     * Quick Schema
     */
    public $title, $definition;

    public function quickSchema()
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
        $this->reset(['title', 'definition']);

        if(!$store)
        {
            toastr("Unable to saved schema!", "error");
            return ;
        }

        toastr("Schema successfully created!", 'success');
    }


    /**
     * Quick User
     */
    public $firstname, $middlename, $lastname, $extension, $email, $password, $role;
    public function getRolesProperty()
    {
        return UserRole::where('is_visible',1)->get();
    }

    public function quickUser()
    {
        if(strlen($this->email) == 0   || strlen($this->role) == 0 || strlen($this->firstname) == 0  || strlen($this->lastname) == 0 )
        {
            toastr("Please fill all required fields!", "error");
            return ;
        }

        $emailAddress = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
        {
            toastr("Invalid email address", "error");
            return ;
        }

        $user = User::firstOrCreate([
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'extension' => $this->extension,
            'email' => $this->email,
            'password' => (strlen($this->password) > 0 ? bcrypt($this->password) : null),
            'role_id' => $this->role,
        ]);
        $user->save();

        $tempAvatar = UserTempAvatar::firstOrCreate([
            'user_id' => $user->id,
            'avatar' => '<span class="avatar-initial rounded-circle '.bgSwitch().'">'.getFirstLettersOfName($this->firstname, $this->lastname).'</span>'
        ]);

        if($user)
        {
            toastr("User successfully saved!", "success");
            $this->reset(['email','role','password','firstname','middlename','lastname','extension',]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.index',[
            'backupList' => $this->backupList,
            'roles' => $this->roles
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - Dashboard'])
        ->section('contents');
    }
}
