<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Worksheets</h5>
            </div>
            <div class="table-responsive text-nowrap perfect-sc" id="perfect-0">

                {{-- Separate Component --}}
                @include('includes.table-top',['root' => 'worksheets', 'text' => 'Add New Worksheet'])
                {{-- Separate Component --}}

                <table class="table table-hover datatable" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Definition</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(!isset($schemas))
                            {!! emptyEndRow(3) !!}
                        @else
                            @if(!is_countable($schemas))
                                {!! emptyEndRow(3) !!}
                            @else
                                @if(count($schemas) == 0)
                                    {!! emptyEndRow(3) !!}
                                @endif

                                @foreach ($schemas as $schema )
                                    <tr id="row-{{ $schema->id }}">
                                        <td>{{ $schema->title }}</td>
                                        <td>{{ $schema->definition }}</td>
                                        <td>

                                            <a href="/schemas/view/{{ $schema->id }}" class="btn btn-sm btn-icon" title="View">
                                                <i class='bx bx-show-alt'></i>
                                            </a>

                                            <a href="/schemas/edit/{{ $schema->id }}" class="btn btn-sm btn-icon" title="Edit">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <button class="btn btn-sm btn-icon" title="Delete" type="button" wire:click.prevent="delete('{{ encipher($schema->id) }}')">
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
                @if(isset($schemas))
                    @include('includes.table-bottom', ['collection' => $schemas])
                @endif
                {{-- Separate Component --}}

            </div>
        </div>

    </div>
</div>
