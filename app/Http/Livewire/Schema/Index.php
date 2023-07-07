<?php

namespace App\Http\Livewire\Schema;

use App\Models\Schema;
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
        $this->all->where('title', 'like', $wildCard)->orWhere('definition', 'like', $wildCard);
    }

    public function getAllProperty()
    {
        return Schema::query();
    }



    public function delete($id)
    {
        $this->deleteItemId = decipher($id);
        sweetalert()
            ->confirmButtonText('Confirm')
            ->showDenyButton(true,'Deny')
            ->addInfo('Are you sure do you want to remove ' . Schema::findOrFail($this->deleteItemId)->title .'?');
    }

    public function sweetalertDenied(array $payload)
    {
        $this->all;
    }

    public function sweetalertConfirmed(array $payload)
    {
        $delete = Schema::findOrFail($this->deleteItemId);
        $delete->delete();
        //$this->all();

        $this->emitSelf('refreshIndexComponent');
    }

    public function render()
    {
        return view('livewire.schema.index',[
            'schemas' => $this->all->latest()->paginate($this->paginate)
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - Schema'])
        ->section('contents');
    }
}
