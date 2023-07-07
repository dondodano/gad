<?php

namespace App\Http\Controllers\Schema;

use PDF;
use App\Models\Schema;
use App\Models\Category;
use App\Models\Worksheet;
use App\Models\Preliminary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchemaController extends Controller
{
    public function view($id)
    {
        $schema = Schema::findOrFail($id)->first()->title;

        $categories = Category::with(['category_worksheets' => function($with) use ($id){
            $with->with('preliminary')->where('schema_id', $id);
        }])->where('active',1)->get();

        $pdf = PDF::loadView('print.schema', compact('schema', 'categories'))->setPaper('a4', 'landscape');
        return $pdf->stream('GAD-DB_'.setToday('YmdHis').'.pdf');
    }
}
