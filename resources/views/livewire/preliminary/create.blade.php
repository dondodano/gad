<div>
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Create Preliminary</h5>
                    <div class="float-end">
                        <a href="/preliminary" class="btn btn-sm btn-secondary">
                            <i class="bx bx-left-arrow-alt"></i> Back to Preliminary list
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form  wire:submit.prevent="store"  enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="category">Category</label>
                            <div class="col-sm-10">
                                <select  id="category" class="form-select" name="category" wire:model.defer="category">
                                    @isset($categories)
                                        @foreach ($categories as $category )
                                            @if($loop->index == 0)
                                                <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endif
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="pretext">Pre-text</label>
                            <div class="col-sm-10">
                                <textarea id="pretext" class="form-control" name="pretext" wire:model.defer="pretext"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="context">Context</label>
                            <div class="col-sm-10">
                                <textarea id="context" class="form-control" name="context" wire:model.defer="context"></textarea>

                                {{-- Removable Serve as Illustration--}}
                                <input id="sequence" type="hidden" name="sequence" wire:model.defer="sequence">
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
