<div>
    <div class="row">
        @role(['super', 'admin'])
            <div class="col-md-6 col-12">
                <div class="card mb-4">
                    <h5 class="card-header">
                        Quick Create User
                    </h5>
                    <form class="card-body" wire:submit.prevent="quickUser" enctype="multipart/form-data" autocomplete="off">
                        <h6 class="mb-b fw-semibold">1. Account Details</h6>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-sm-end" for="email">Email</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input type="text" id="email" class="form-control"  aria-describedby="email2" name="email" wire:model.defer="email" autocomplete="off">
                                    <span class="input-group-text" id="email2"><i class="bx bx-envelope"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 form-password-toggle">
                            <label class="col-sm-3 col-form-label text-sm-end" for="password">Password</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control"  aria-describedby="password2" name="password"  wire:model.defer="password" autocomplete="off">
                                    <span class="input-group-text cursor-pointer" id="password2"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-sm-end" for="role">Role</label>
                            <div class="col-sm-9">
                                <select  id="role" class="form-select" name="role"  wire:model.defer="role">
                                    <option value="">-- Select Role --</option>
                                    @isset($roles)
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" >{{ $role->term }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>

                        <hr class="my-4 mx-n4">

                        <h6 class="mb-3 fw-semibold">2. Personal Info</h6>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-sm-end" for="firstname">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="firstname" class="form-control" name="firstname" wire:model.defer="firstname">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-sm-end" for="middlename">Middle Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="middlename" class="form-control" name="middlename"  wire:model.defer="middlename">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-sm-end" for="lastname">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="lastname" class="form-control" name="lastname"  wire:model.defer="lastname">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-sm-end" for="extension">Extension</label>
                            <div class="col-sm-9">
                                <input type="text" id="extension" class="form-control" name="extension"  wire:model.defer="extension">
                            </div>
                        </div>

                        <div class="pt-4">
                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-sm-2 me-1" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary" name="cancel">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endrole

        <div class="{{ in_array(strtolower(session('role')), ['admin', 'super']) ? 'col-md-6' : null }} col-12 mb-4">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Quick Create Schema</h5>
                    <div class="float-end">
                    </div>
                </div>
                <div class="card-body">
                    <form  wire:submit.prevent="quickSchema"  enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="title">Title</label>
                            <div class="col-sm-9">
                                <input type="text" id="title" class="form-control phone-mask" name="title" wire:model.defer="title">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="definition">Definition</label>
                            <div class="col-sm-9">
                                <textarea id="definition" class="form-control" name="definition" wire:model.defer="definition"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" name="cancel">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @role(['super', 'admin'])
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Quick Backup</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <table class="table table-hover datatable" id="datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Filename</th>
                                            <th>Date Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if(!isset($backupList))
                                            {!! emptyEndRow(2) !!}
                                        @else
                                            @if(!is_countable($backupList))
                                                {!! emptyEndRow(2) !!}
                                            @else
                                                @if(count($backupList) == 0)
                                                    {!! emptyEndRow(2) !!}
                                                @endif

                                                @foreach ($backupList as $file )
                                                    <tr id="row-{{ $loop->index }}">
                                                        <td class="text-wrap">{{ $file['filename'] }}</td>
                                                        <td class="text-wrap">{{ date("M. d, Y h:i:s A", filectime($file["location"])) }}</td>
                                                    </td>
                                                @endforeach
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <button class="btn btn-primary d-grid w-100" wire:click.prevent="quickBackup" wire:loading.attr="disabled" wire:targe="quickBackup">
                                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                                        <i class='bx bx-hdd bx-xs me-1' wire:loading.remove wire:target="quickBackup"></i>New Backup
                                        <span class="spinner-border spinner-border-sm text-primary" role="status" id="spiner" wire:loading wire:target="quickBackup"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </div>
</div>
