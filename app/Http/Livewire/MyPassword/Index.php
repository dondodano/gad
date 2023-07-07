<?php

namespace App\Http\Livewire\MyPassword;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{

    public $currentPassword, $newPassword, $confirmPassword, $fullname, $role, $user;

    public function mount()
    {
        $this->user = User::findOrFail(Auth::user()->id);

        $this->fullname = fullName();
        $this->role = sessionGet('role');
    }

    public function execute()
    {
        $sessionPassword = sessionGet('password'); //Already hashed

        if(strlen($this->currentPassword) == 0 || strlen($this->newPassword) == 0 || strlen($this->confirmPassword) == 0)
        {
            toastr("Please fill all fields!", "error");
            return;
        }

        if(!Hash::check($this->currentPassword, $sessionPassword))
        {
            toastr("Invalid password!", "error");
            return;
        }

        if($this->newPassword != $this->confirmPassword)
        {
            toastr("Mismatched password!", "error");
            return;
        }

        $hashedPassword = bcrypt($this->newPassword);

        $this->user->update([
            'password' => $hashedPassword
        ]);

        session([ 'password' => $hashedPassword ]);
        toastr("Password successfully updated!", "success");
        $this->resetExcept([
            'fullname','role'
        ]);

        $this->dispatchBrowserEvent('reloadComponent');
    }

    public function render()
    {
        return view('livewire.my-password.index')
        ->extends('livewire.components.master', ['title' => 'GAD - My Password'])
        ->section('contents');
    }
}
