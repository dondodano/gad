<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\UserRole;
use App\Models\UserTempAvatar;

class Create extends Component
{
    public $firstname, $middlename, $lastname, $extension, $email, $password, $role;

    public function getRolesProperty()
    {
        return UserRole::where('is_visible',1)->get();
    }

    public function store()
    {
        if(strlen($this->email) == 0   || strlen($this->role) == 0 || strlen($this->firstname) == 0 || strlen($this->lastname) == 0 )
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
            $this->reset();
        }
    }

    public function render()
    {
        return view('livewire.user.create',[
            'roles' => $this->roles
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - User'])
        ->section('contents');
    }
}
