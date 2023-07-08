<?php

namespace App\Http\Livewire\LogActivity;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $wildCard = "%".$this->search."%";
        $this->all->where('description', 'like', $wildCard);
    }

    public function getAllProperty()
    {
        return Activity::query();
    }

    public function render()
    {
        return view('livewire.log-activity.index',[
            'activities' => $this->all->latest()->paginate($this->paginate)
        ])
        ->extends('livewire.components.master', ['title' => 'GAD - Log Activity'])
        ->section('contents');
    }
}
