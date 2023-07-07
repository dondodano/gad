<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    public $deleteItemId;

    protected $listeners = [
        'sweetalertConfirmed',
        'sweetalertDenied',
        'refreshIndexComponent' => 'render'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $wildCard = "%".$this->search."%";
        $this->all->where('firstname', 'like', $wildCard)
            ->orWhere('middlename', 'like', $wildCard)
            ->orWhere('lastname', 'like', $wildCard)
            ->orWhere('extension', 'like', $wildCard)
            ->orWhere('email', 'like', $wildCard);
    }

    public function getAllProperty()
    {
        return User::query();
    }

    public function delete($id)
    {
        $this->deleteItemId = decipher($id);

        $user = User::findOrFail($this->deleteItemId);

        sweetalert()
            ->confirmButtonText('Confirm')
            ->showDenyButton(true,'Deny')
            ->addInfo('Are you sure do you want to remove ' . ucwords($user->firstname. ' '. $user->lastname) .'?');
    }

    public function sweetalertDenied(array $payload)
    {
        $this->all;
    }

    public function sweetalertConfirmed(array $payload)
    {
        $delete = user::findOrFail($this->deleteItemId);
        $delete->delete();
        //$this->all();

        $this->emitSelf('refreshIndexComponent');
    }

    public function status($id)
    {
        $userId = decipher($id);
        $user = User::findOrFail($userId);
        if($user->active == 1)
        {
            $user->active = 0;
            $user->update();
            return;
        }

        $user->active = 1;
        $user->update();
    }

    public function render()
    {
        return view('livewire.user.index',[
            'users' => $this->all->latest()->paginate($this->paginate)
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - User'])
        ->section('contents');
    }
}
