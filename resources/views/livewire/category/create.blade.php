<div>
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Create Category</h5>
                    <div class="float-end">
                        <a href="/category" class="btn btn-sm btn-secondary">
                            <i class="bx bx-left-arrow-alt"></i> Back to Category list
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form  wire:submit.prevent="store"  enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title">Title</label>
                            <div class="col-sm-10">
                                <textarea id="title" class="form-control" name="title" wire:model.defer="title"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" name="cancel">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
