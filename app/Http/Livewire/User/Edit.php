<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\UserRole;
use App\Models\UserTempAvatar;
use Illuminate\Support\Facades\Auth as Auths;

class Edit extends Component
{
    public $firstname, $middlename, $lastname, $extension, $email, $password, $role,  $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);

        if($this->user->role_id == 1)
        {
            return abort(404);
        }

        $this->firstname = $this->user->firstname;
        $this->middlename = $this->user->middlename;
        $this->lastname = $this->user->lastname;
        $this->extension = $this->user->extensiion;
        $this->email = $this->user->email;
        $this->role = $this->user->role_id;

    }

    public function getRolesProperty()
    {
        return UserRole::where('is_visible',1)->get();
    }

    public function update()
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

        $user = $this->user->update([
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'extension' => $this->extension,
            'email' => $this->email,
            'password' => (strlen($this->password) > 4 ? bcrypt($this->password) : $this->user->password),
            'role_id' => $this->role,
        ]);

        $tempAvatar = UserTempAvatar::where('user_id', $this->user->id)->update([
            'user_id' => $this->user->id,
            'avatar' => '<span class="avatar-initial rounded-circle '.bgSwitch().'">'.getFirstLettersOfName($this->firstname, $this->lastname).'</span>'
        ]);

        if($user)
        {
            activity()
                ->causedBy(Auths::user())
                ->performedOn($this->user)
                ->log('updated');
            toastr("User successfully updated!", "success");
        }
    }

    public function render()
    {
        return view('livewire.user.edit',
        [
            'roles' => $this->roles
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - User'])
        ->section('contents');
    }
}
