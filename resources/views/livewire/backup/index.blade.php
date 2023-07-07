<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Backups</h5>
            </div>
            <div class="table-responsive text-nowrap perfect-sc" id="perfect-0">

                {{-- Separate Component --}}
                <div class="d-flex flex-nowrap border-bottom mt-3">
                    <div class="flex-fill mb-3">
                        <div class="d-flex flex-row ">
                            <div class="ms-3 ">
                                <select class="form-select" wire:model="paginate">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex-fill mb-3">
                        <div class="d-flex flex-row justify-content-end">
                            <div class="me-3">
                                <input type="search" class="form-control" placeholder="Search" wire:model.debounce.500ms="search" >
                            </div>
                            <div class="me-3">
                                <button class="btn btn-primary" wire:click.prevent="backup" wire:loading.attr="disabled" wire:targe="backup">
                                    <i class="bx bx-plus" wire:loading.remove wire:target="backup"></i>
                                    <span class="spinner-border spinner-border-sm text-primary" role="status" id="spiner" wire:loading wire:target="backup"></span>
                                    Create Backup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Separate Component --}}

                <table class="table table-hover datatable" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th>Filename</th>
                            <th>Size</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(!isset($files))
                            {!! emptyEndRow(4) !!}
                        @else
                            @if(!is_countable($files))
                                {!! emptyEndRow(4) !!}
                            @else
                                @if(count($files) == 0)
                                    {!! emptyEndRow(4) !!}
                                @endif

                                @foreach ($files as $file )
                                    <tr id="row-{{ $loop->index }}">
                                        <td>{{ $file['filename'] }}</td>
                                        <td>{{ getFileSize(filesize($file['location'])) }}</td>
                                        <td>{{ date("M. d, Y h:i:s A", filectime($file["location"])) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-icon" title="Download" type="button" wire:click.prevent="download('{{ encipher($file['filename']) }}')">
                                                <i class='bx bx-download'></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon" title="Delete" type="button" wire:click.prevent="delete('{{ encipher($file['filename']) }}')">
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
                @if(isset($files))
                    @include('includes.table-bottom', ['collection' => $files])
                @endif
                {{-- Separate Component --}}

            </div>
        </div>

    </div>
</div>
