<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Categories</h5>
            </div>
            <div class="table-responsive text-nowrap perfect-sc" id="perfect-0">

                {{-- Separate Component --}}
                @include('includes.table-top',['root' => 'category', 'text' => 'Add New Category'])
                {{-- Separate Component --}}

                <table class="table table-hover datatable" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(!isset($categories))
                            {!! emptyEndRow(3) !!}
                        @else
                            @if(!is_countable($categories))
                                {!! emptyEndRow(3) !!}
                            @else
                                @if(count($categories) == 0)
                                    {!! emptyEndRow(3) !!}
                                @endif

                                @foreach ($categories as $category )
                                    <tr id="row-{{ $category->id }}">
                                        <td>{{ $category->title }}</td>
                                        <td>
                                            @if($category->active == 1)
                                                <i class="bx bx-check-circle text-success" title="Active"></i>
                                            @else
                                                <i class='bx bx-x-circle text-danger' title="Inactive"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-icon" title="Change status to {{ ($category->active == 1 ? 'Inactive' : 'Active') }}" type="button" wire:click.prevent="status('{{ encipher($category->id) }}')">
                                                @if($category->active == 1)
                                                <i class='bx bx-x-circle text-danger'></i>
                                                @else
                                                <i class='bx bx-plus-circle text-success'></i>
                                                @endif
                                            </button>

                                            <a href="/category/edit/{{ $category->id }}" class="btn btn-sm btn-icon" title="Edit">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <button class="btn btn-sm btn-icon" title="Delete" type="button" wire:click.prevent="delete('{{ encipher($category->id) }}')">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </td>
                                    </td>
                                @endforeach
                            @endif
                        @endif



                    </tbody>
                </table>

                {{-- Separate Component --}}
                @if(isset($categories))
                    @include('includes.table-bottom', ['collection' => $categories])
                @endif
                {{-- Separate Component --}}

            </div>
        </div>

    </div>
</div>
