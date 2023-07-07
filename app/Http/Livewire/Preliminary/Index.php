<?php

namespace App\Http\Livewire\Preliminary;

use Livewire\Component;
use App\Models\Preliminary;
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
        $this->all->where('pretext', 'like', $wildCard)->where('active',1)
            ->orWhere('context', 'like', $wildCard)->where('active',1);
    }

    public function getAllProperty()
    {
        return Preliminary::query();
    }

    public function status($id)
    {
        $preliminaryId = decipher($id);
        $preliminary = Preliminary::findOrFail($preliminaryId);
        if($preliminary->active == 1)
        {
            $preliminary->active = 0;
            $preliminary->update();
            return;
        }

        $preliminary->active = 1;
        $preliminary->update();
    }

    public function delete($id)
    {
        $this->deleteItemId = decipher($id);
        sweetalert()
            ->confirmButtonText('Confirm')
            ->showDenyButton(true,'Deny')
            ->addInfo('Are you sure do you want to remove this item?');
    }

    public function sweetalertDenied(array $payload)
    {
        $this->all;
    }

    public function sweetalertConfirmed(array $payload)
    {
        $delete = Preliminary::findOrFail($this->deleteItemId);
        $delete->delete();
        //$this->all();

        $this->emitSelf('refreshIndexComponent');
    }

    public function render()
    {
        return view('livewire.preliminary.index',[
            'preliminaries' => $this->all->orderByRaw('sequence ASC')->paginate($this->paginate)
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - Preliminary'])
        ->section('contents');
    }
}
