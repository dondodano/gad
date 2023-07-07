<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
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
        $this->all->where('title', 'like', $wildCard)->where('active',1);
    }

    public function getAllProperty()
    {
        return Category::query();
    }

    public function status($id)
    {
        $categoryId = decipher($id);
        $category = Category::findOrFail($categoryId);
        if($category->active == 1)
        {
            $category->active = 0;
            $category->update();
            return;
        }

        $category->active = 1;
        $category->update();
    }

    public function delete($id)
    {
        $this->deleteItemId = decipher($id);
        sweetalert()
            ->confirmButtonText('Confirm')
            ->showDenyButton(true,'Deny')
            ->addInfo('Are you sure do you want to remove ' . Category::findOrFail($this->deleteItemId)->title .'?');
    }

    public function sweetalertDenied(array $payload)
    {
        $this->all;
    }

    public function sweetalertConfirmed(array $payload)
    {
        $delete = Category::findOrFail($this->deleteItemId);
        $delete->delete();
        //$this->all();

        $this->emitSelf('refreshIndexComponent');
    }

    public function render()
    {
        return view('livewire.category.index',[
            'categories' => $this->all->latest()->paginate($this->paginate)
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - Category'])
        ->section('contents');
    }
}
