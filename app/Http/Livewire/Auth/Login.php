<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\SettingGeneral;
use Illuminate\Support\Facades\Auth as Auths;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function login()
    {
        $this->validate();

        if(Auths::attempt([ 'email' => $this->email, 'password' => $this->password], $this->remember))
        {
            session()->regenerate();

            $fullname = [
                'firstname' => Auths::user()->firstname,
                'middlename' => Auths::user()->middlename,
                'lastname' => Auths::user()->lastname,
                'extension' => Auths::user()->extension,
            ];

            session([
                'session' => token(),
                'id' => Auths::user()->id,
                'email' => Auths::user()->email,
                'password' => Auths::user()->password,
                'role_id' => Auths::user()->role_id,
                'role' => Auths::user()->user_role->term,
                'avatar' => Auths::user()->avatar,
                'temp_avatar' => !empty(Auths::user()->temp_avatar) ? Auths::user()->temp_avatar->avatar : '',
                'name_array' => $fullname,
                'webicon' => SettingGeneral::findOrFail(1)->web_icon,
                'current_year' => setToday('Y'),
            ]);

            toastr("Welcome! You have successfully logged in.", "success");
            return redirect()->intended('/dashboard');
        }else{
            toastr("These credentials do not match our records.", "error");
        }
    }

    public function render()
    {
        return view('livewire.auth.login')
        ->extends('livewire.components.auth', ['title' => 'Login'])
        ->section('contents');
    }
}
