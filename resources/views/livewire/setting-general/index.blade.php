<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">General</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update" >
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="site_title">Site Title</label>
                        <div class="col-sm-10">
                            <input type="text" id="site_title" class="form-control" name="site_title" wire:model.defer="site_title">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="site_definition">Site Definition</label>
                        <div class="col-sm-10">
                            <textarea id="site_definition" class="form-control" name="site_definition" wire:model.defer="site_definition"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="entity_name">Entity Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="entity_name" class="form-control" name="entity_name" wire:model.defer="entity_name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="entity_definition">Entity Definition</label>
                        <div class="col-sm-10">
                            <textarea id="entity_definition" class="form-control" name="entity_definition" wire:model.defer="entity_definition"></textarea>
                        </div>
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
