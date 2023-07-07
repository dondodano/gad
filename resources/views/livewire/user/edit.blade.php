<div>
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <h5 class="card-header">
                    Edit User
                    <div class="float-end">
                        <a href="/user" class="btn btn-sm btn-secondary">
                            <i class='bx bx-left-arrow-alt'></i> Back to User list
                        </a>
                    </div>
                </h5>
                <form class="card-body" wire:submit.prevent="update" enctype="multipart/form-data" autocomplete="off">

                    @csrf

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
                        <label class="col-sm-3 col-form-label text-sm-end" for="role">Role </label>
                        <div class="col-sm-9">
                            <select  id="role" class="form-select" name="role"  wire:model.defer="role">
                                <option value="">-- Select Role --</option>
                                @isset($roles)
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->term }}</option>
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
