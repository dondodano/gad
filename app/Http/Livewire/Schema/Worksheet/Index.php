<?php

namespace App\Http\Livewire\Schema\Worksheet;

use Livewire\Component;
use App\Models\Category;
use App\Models\Worksheet;
use App\Models\Preliminary;
use Illuminate\Support\Collection;

class Index extends Component
{
    public $filterCategory, $resetFilter;
    public $schemaId;

    public function mount($id)
    {
        $this->schemaId = $id;
    }

    public function female($val, $preliminaryId, $categoryId)
    {
        $worksheet = Worksheet::where('schema_id', $this->schemaId)->where('preliminary_id', $preliminaryId);
        if(!$worksheet->exists())
        {
            $create = Worksheet::firstOrCreate([
                'schema_id' => $this->schemaId,
                'category_id' => $categoryId,
                'preliminary_id' => $preliminaryId,
                'female' => $val
            ]);
            $create->save();
            return;
        }

        $worksheet->update([
            'female' => $val
        ]);
    }

    public function male($val, $preliminaryId, $categoryId)
    {
        $worksheet = Worksheet::where('schema_id', $this->schemaId)->where('preliminary_id', $preliminaryId);
        if($worksheet->doesntExist())
        {
            $create = Worksheet::firstOrCreate([
                'schema_id' => $this->schemaId,
                'category_id' => $categoryId,
                'preliminary_id' => $preliminaryId,
                'male' => $val
            ]);
            $create->save();
            return;
        }

        $worksheet->update([
            'male' => $val
        ]);
    }

    public function updatedFilterCategory()
    {
        $this->preliminaries;
    }

    public function resetFilter()
    {
        $this->filterCategory = "";
    }

    public function getPreliminariesProperty()
    {
        return Preliminary::when($this->filterCategory, function($where){
            if(strlen($this->filterCategory) > 0)
            {
                $where->where('category_id', $this->filterCategory);
            }
        })->with(['worksheet' => function($query){
            return $query->where('schema_id', '=', $this->schemaId);
        }])->where('active',1)->orderByRaw('sequence ASC');
    }

    public function render()
    {
        return view('livewire.schema.worksheet.index',[
            'preliminaries' => $this->preliminaries->get(),
            'categories' => Category::where('active',1)->get()
        ])
        ->extends('livewire.components.master', ['title' => 'Schema - Worksheet'])
        ->section('contents');
    }
}
