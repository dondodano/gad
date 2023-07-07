<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <h5 class="card-header">
                My Password
            </h5>
            <form class="card-body" wire:submit.prevent="execute">

                @csrf

                <h6 class="mb-b fw-semibold">1. Account Details</h6>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="fullname">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="fullname" class="form-control" placeholder="Fullname" name="fullname" wire:model.defer="fullname" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="role">Role</label>
                    <div class="col-sm-9">
                        <input type="text" id="role" class="form-control" placeholder="Role" name="role"  wire:model.defer="role"  disabled>
                    </div>
                </div>

                <hr class="my-4 mx-n4">

                <h6 class="mb-3 fw-semibold">2. Password</h6>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="current-password">Current Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="current-password" class="form-control" name="current-password" wire:model.defer="currentPassword" >
                    </div>
                </div>

                <div class="divider divider-dashed">
                    <div class="divider-text">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="new-password">New Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="new-password" class="form-control" name="new-password"  wire:model.defer="newPassword">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label text-sm-end" for="confirm-password">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="confirm-password" class="form-control" name="confirm-password"   wire:model.defer="confirmPassword">
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
