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
                        </div>
                    </div>
                </div>

                {{-- Separate Component --}}

                <table class="table table-hover datatable" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th>Logged Date</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>Causer</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(!isset($activities))
                            {!! emptyEndRow(4) !!}
                        @else
                            @if(!is_countable($activities))
                                {!! emptyEndRow(4) !!}
                            @else
                                @if(count($activities) == 0)
                                    {!! emptyEndRow(4) !!}
                                @endif

                                @foreach ($activities as $activity )
                                    <tr id="row-{{ $loop->index }}">
                                        <td>{{ setDate($activity->created_at) }}</td>
                                        <td>
                                            @switch(strtolower($activity->description))
                                                @case('created')
                                                    <span class="badge bg-label-success">{{ strtoupper($activity->description) }}</span>
                                                    @break

                                                @case('updated')
                                                    <span class="badge bg-label-info">{{ strtoupper($activity->description) }}</span>
                                                    @break

                                                @case('deleted')
                                                    <span class="badge bg-label-danger">{{ strtoupper($activity->description) }}</span>
                                                    @break

                                                @case('logged-in')
                                                    <span class="badge bg-label-success">{{ strtoupper($activity->description) }}</span>
                                                    @break

                                                @case('logged-out')
                                                    <span class="badge bg-label-warning">{{ strtoupper($activity->description) }}</span>
                                                    @break

                                                @default

                                            @endswitch
                                        </td>
                                        <td>{{ basename($activity->subject_type) }} where id = {{ $activity->subject_id }}</td>
                                        <td>
                                            <span class="badge bg-label-primary">{{
                                                concat(' ', [
                                                    $activity->itsowner->firstname,
                                                    getMiddleInitial($activity->itsowner->middlename),
                                                    $activity->itsowner->lastname,
                                                ])
                                            }}</span>
                                        </td>
                                    </td>
                                @endforeach
                            @endif
                        @endif



                    </tbody>
                </table>

                {{-- Separate Component --}}
                @if(isset($activities))
                    @include('includes.table-bottom', ['collection' => $activities])
                @endif
                {{-- Separate Component --}}

            </div>
        </div>

    </div>
</div>
