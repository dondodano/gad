<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Worksheet</h5>
            </div>
            <div class="table-responsive text-nowrap perfect-sc" id="perfect-0">

                {{-- Filter --}}
                <div class="d-flex flex-nowaap border-bottom">
                    <div class="flex-fill p-3">
                        <select class="form-select" wire:model="filterCategory" >
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="p-3">
                        <button class="btn btn-secondary" type="button" wire:click="resetFilter" title="Reset Filter">
                            <i class="bx bx-reset me-2"></i> Reset Filter
                        </button>
                    </div>

                    {{-- <div class="p-3">
                        <button class="btn btn-primary" type="button" wire:click="store" title="Save Data">
                            <i class='bx bx-save me-2'></i> Save Data
                        </button>
                    </div> --}}
                </div>
                {{-- Filter --}}

                <table class="table table-hover datatable" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th>Order</th>
                            <th>Context</th>
                            <th>Category</th>
                            <th>Female</th>
                            <th>Male</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(!isset($preliminaries))
                            {!! emptyEndRow(6) !!}
                        @else
                            @if(!is_countable($preliminaries))
                                {!! emptyEndRow(6) !!}
                            @else
                                @if(count($preliminaries) == 0)
                                    {!! emptyEndRow(6) !!}
                                @endif

                                @foreach ($preliminaries as $preliminary )
                                    <tr class="trow" id="row-{{ $preliminary->id }}">
                                        <td>
                                            <span class="badge bg-label-danger badge-center rounded-pill w-px-30 h-px-30">{{ $preliminary->sequence }}</span>
                                        </td>
                                        <td class="text-wrap text-break" style="max-width: 320px;">
                                            @if(strlen($preliminary->pretext) > 0)
                                                {{ $preliminary->pretext }}<br/>
                                            @endif
                                            {{ $preliminary->context }}
                                        </td>
                                        <td class="text-wrap">
                                            <span class="badge bg-label-info">{{ $preliminary->category->title }}</span>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control entry female" id="female-{{ $preliminary->id }}" min="0" style="max-width: 80px;" wire:change="female($event.target.value,{{ $preliminary->id }},{{ $preliminary->category_id }})" value="{{ empty($preliminary->worksheet) ? '0' : $preliminary->worksheet->female }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control entry male" id="male-{{ $preliminary->id }}" min="0" style="max-width: 80px;" wire:change="male($event.target.value,{{ $preliminary->id }},{{ $preliminary->category_id }})" value="{{ empty($preliminary->worksheet) ? '0' : $preliminary->worksheet->male }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control total" id="total-{{ $preliminary->id }}" min="0" readonly  style="max-width: 80px;" value="{{ sumGender($preliminary) }}">
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif

                    </tbody>
                </table>


            </div>
        </div>

    </div>
</div>

@push('body')
<script>
$(document).ready(function(){
    $('.entry').on('change', function(){
        let parent = $(this).parent().parent()
        let parentId = parent.attr('id').split('-')[1]
        let female = $('#female-'+parentId).val()
        let male = $('#male-'+parentId).val()

        if(female.length > 0 && male.length > 0)
        {
            let total = parseInt(female) + parseInt(male);
            $('#total-'+parentId).val(total)
        }
    })
})
</script>
@endpush
