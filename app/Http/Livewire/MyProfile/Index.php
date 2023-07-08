<?php

namespace App\Http\Livewire\MyProfile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $avatar, $firstname, $middlename, $lastname, $extension, $email, $fullname, $role, $user;

    public function mount()
    {
        if(!Storage::exists('/public/avatar/'))
        {
            Storage::makeDirectory( '/public/avatar/');
        }

        $this->firstname = sessionGet('name_array')['firstname'];
        $this->middlename = sessionGet('name_array')['middlename'];
        $this->lastname = sessionGet('name_array')['lastname'];
        $this->extension = sessionGet('name_array')['extension'];
        $this->email = sessionGet('email');
        $this->fullname = fullName();
        $this->role = sessionGet('role');

        $this->user = User::findOrFail(Auth::user()->id);
    }

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'image:max:2048'
        ]);
    }

    public function execute()
    {

        session([
            'name_array' => [
                'firstname' => $this->firstname,
                'middlename' => $this->middlename,
                'lastname' => $this->lastname,
                'extension' => $this->extension,
            ],
            'email' => $this->email
        ]);

        $this->user->update([
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'extension' => $this->extension,
            'email' => $this->email,
            'avatar' => ($this->avatar != null ? 'avatar/'.$this->avatar->getClientOriginalName() : null)
        ]);

        if($this->avatar != null){
            $this->avatar->storeAs('public/avatar/', $this->avatar->getClientOriginalName());
            session([
                'avatar' => 'avatar/'.$this->avatar->getClientOriginalName()
            ]);
            unlink(storage_path('app/livewire-tmp/') . $this->avatar->getFilename());
        }

        activity()
            ->causedBy(Auths::user())
            ->performedOn($this->user)
            ->log('updated');

        toastr('User profile updated');
        $this->dispatchBrowserEvent('reloadComponent');
    }

    public function render()
    {
        return view('livewire.my-profile.index')
        ->extends('livewire.components.master', ['title' => 'GAD - My Profile'])
        ->section('contents');
    }
}
