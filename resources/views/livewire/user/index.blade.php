<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Users</h5>
            </div>
            <div class="table-responsive text-nowrap perfect-sc" id="perfect-0">

                {{-- Separate Component --}}
                @include('includes.table-top',['root' => 'user', 'text' => 'Add New User'])
                {{-- Separate Component --}}

                <table class="table table-hover datatable" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(!isset($users))
                            {!! emptyEndRow(5) !!}
                        @else
                            @if(!is_countable($users))
                                {!! emptyEndRow(5) !!}
                            @else
                                @if(count($users) == 0)
                                    {!! emptyEndRow(5) !!}
                                @endif

                                @foreach ($users as $user )
                                    <tr id="row-{{ $user->id }}">
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center user-name">
                                                @if(!empty($user->temp_avatar))
                                                    {!! avatarWrapper($user->temp_avatar->avatar, 'avatar-sm') !!}
                                                @else
                                                    {!! avatarWrapper('<span class="avatar-initial rounded-circle '.bgSwitch().'">'.getFirstLettersOfName($user->firstname, $user->lastname).'</span>', 'avatar-sm') !!}
                                                @endif
                                                <div class="d-flex flex-column">
                                                    <a href="/edit/1" class="text-body text-truncate">
                                                        <span class="fw-semibold">
                                                            {{ concat(' ',[
                                                                $user->firstname,
                                                                getMiddleInitial($user->middlename),
                                                                $user->lastname
                                                            ]) }}
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @isset($user->user_role)
                                                <span class="badge bg-info">{{ $user->user_role->term }}</span>
                                            @else
                                                <span class="badge bg-secondary">Not Set</span>
                                            @endisset
                                        </td>
                                        <td>
                                            @if($user->active == 1)
                                                <i class="bx bx-check-circle text-success" title="Active"></i>
                                            @else
                                                <i class='bx bx-x-circle text-danger' title="Inactive"></i>
                                            @endif
                                        </td>
                                        <td>


                                            <button class="btn btn-sm btn-icon" title="Change status to {{ ($user->active == 1 ? 'Inactive' : 'Active') }}" type="button" wire:click.prevent="status('{{ encipher($user->id) }}')">
                                                @if($user->active == 1)
                                                <i class='bx bx-x-circle text-danger'></i>
                                                @else
                                                <i class='bx bx-plus-circle text-success'></i>
                                                @endif
                                            </button>

                                            <a href="/user/edit/{{ $user->id }}" class="btn btn-sm btn-icon" title="Edit">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <button class="btn btn-sm btn-icon" title="Delete" type="button" wire:click.prevent="delete('{{ encipher($user->id) }}')">
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
                @if(isset($users))
                    @include('includes.table-bottom', ['collection' => $users])
                @endif
                {{-- Separate Component --}}

            </div>
        </div>

    </div>
</div>
