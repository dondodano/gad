<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">System maintenance</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 col-6 mb-3">
                        <strong>System mode:</strong>
                        @if(isMaintenance() == false)
                            <span class="btn btn-success btn-sm" title="Online">
                                <i class='bx bx-rocket'></i> Online
                            </span>
                        @else
                            <span class="btn btn-danger btn-sm" title="Maintenance Mode">
                                <i class='bx bx-downvote'></i> Maintenance Mode
                            </span>
                        @endif
                    </div>

                    <div class="col-md-4 col-6 mb-3">
                        @if(isMaintenance() == false)
                            <button type="submit" class="btn btn-outline-danger btn-sm" name="switch" wire:click.prevent="maintenance('true')">
                                <i class='bx bx-transfer-alt'></i>
                                Switch to Maintenance mode
                            </button>
                        @else
                            <button type="submit" class="btn btn-outline-success btn-sm" name="switch" wire:click.prevent="maintenance('false')">
                                <i class='bx bx-transfer-alt'></i>
                                Switch to Online mode
                            </button>
                        @endif
                        <br/>
                        <p class="text-light">
                            <small>Click here to switch between modes.</small>
                        </p>
                    </div>

                    <div class="col-md-4 col-12">
                        <p class="text-break text-wrap">
                            Enabling <strong>Maintenance Mode</strong> will make the whole system unaccessible. To disable <strong>Maintenance mode</strong>
                            You need to access the url to your browser and type the command : <span class="badge bg-secondary">system:up</span>. <i class="bg-label-danger "  style="padding:5px 0px;">(ex.) 127.0.0.1:8000/ system:up</i>
                            After executing the command, the system will change into running state.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
