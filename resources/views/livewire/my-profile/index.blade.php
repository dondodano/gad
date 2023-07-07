<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <h5 class="card-header">
                My Profile
            </h5>
            <form class="card-body" wire:submit.prevent="execute" enctype="multipart/form-data">

                @csrf

                <h6 class="mb-b fw-semibold">1. Avatar</h6>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" >Avatar</label>
                    <div class="col-sm-9">
                        {!! avatar("avatar-xl") !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="avatar">Upload</label>
                    <div class="col-sm-9">
                        <input type="file" id="avatar" class="form-control"  name="avatar" wire:model="avatar" >
                        <div wire:loading wire:target="avatar" class="text-info">Uploading...</div>
                    </div>
                    @error('file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <hr class="my-4 mx-n4">

                <h6 class="mb-b fw-semibold">2. Profile details</h6>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="fullname">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="fullname" class="form-control" placeholder="Fullname" name="fullname" wire:model.defer="fullname" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="role">Role</label>
                    <div class="col-sm-9">
                        <input type="text" id="role" class="form-control" placeholder="Role" name="role" wire:model.defer="role" disabled>
                    </div>
                </div>

                <hr class="my-4 mx-n4">

                <h6 class="mb-3 fw-semibold">3. Personal Information</h6>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="firstname">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstname" class="form-control" name="firstname" wire:model.defer="firstname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="middlename">Middle Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="middlename" class="form-control" name="middlename" wire:model.defer="middlename">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="lastname">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="lastname" class="form-control" name="lastname" wire:model.defer="lastname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="extension">Extension</label>
                    <div class="col-sm-9">
                        <input type="text" id="extension" class="form-control" name="extension" wire:model.defer="extension">
                    </div>
                </div>

                <hr class="my-4 mx-n4">

                <h6 class="mb-3 fw-semibold">4. Credential</h6>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="email">Email</label>
                    <div class="col-sm-9">
                        <input type="text" id="email" class="form-control" name="email" wire:model.defer="email">
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
