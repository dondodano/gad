<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Fav Icon</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="upload" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="siteicon">Site Icon</label>
                        <div class="col-sm-10">
                            <img src="{{ getFileShortLocation(sessionGet('webicon')) }}" width="96" />
                        </div>


                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="file">Upload Image</label>
                        <div class="col-sm-10">
                            <input type="file" id="webicon" class="form-control" name="file" wire:model="file">
                            <div wire:loading wire:target="file" class="text-info">Uploading...</div>
                        </div>
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
