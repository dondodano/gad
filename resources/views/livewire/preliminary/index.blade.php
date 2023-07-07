<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Preliminaries</h5>
            </div>
            <div class="table-responsive text-nowrap perfect-sc" id="perfect-0">

                {{-- Separate Component --}}
                @include('includes.table-top',['root' => 'preliminary', 'text' => 'Add New Preliminary'])
                {{-- Separate Component --}}

                <table class="table table-hover datatable" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th>Category</th>
                            <th>Context</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(!isset($preliminaries))
                            {!! emptyEndRow(4) !!}
                        @else
                            @if(!is_countable($preliminaries))
                                {!! emptyEndRow(4) !!}
                            @else
                                @if(count($preliminaries) == 0)
                                    {!! emptyEndRow(4) !!}
                                @endif

                                @foreach ($preliminaries as $preliminary )
                                    <tr id="row-{{ $preliminary->id }}">
                                        <td>{{ $preliminary->category->title }}</td>
                                        <td title="{{ $preliminary->pretext . ' ' . $preliminary->context}}">{{ shorten($preliminary->pretext) . ' ' . shorten($preliminary->context) }}</td>
                                        <td>
                                            @if($preliminary->active == 1)
                                                <i class="bx bx-check-circle text-success" title="Active"></i>
                                            @else
                                                <i class='bx bx-x-circle text-danger' title="Inactive"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-icon" title="Change status to {{ ($preliminary->active == 1 ? 'Inactive' : 'Active') }}" type="button" wire:click.prevent="status('{{ encipher($preliminary->id) }}')">
                                                @if($preliminary->active == 1)
                                                <i class='bx bx-x-circle text-danger'></i>
                                                @else
                                                <i class='bx bx-plus-circle text-success'></i>
                                                @endif
                                            </button>

                                            <a href="/preliminary/edit/{{ $preliminary->id }}" class="btn btn-sm btn-icon" title="Edit">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <button class="btn btn-sm btn-icon" title="Delete" type="button" wire:click.prevent="delete('{{ encipher($preliminary->id) }}')">
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
                @if(isset($preliminaries))
                    @include('includes.table-bottom', ['collection' => $preliminaries])
                @endif
                {{-- Separate Component --}}

            </div>
        </div>

    </div>
</div>
