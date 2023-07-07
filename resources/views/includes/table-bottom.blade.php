@if(isset($collection))
    @if(is_countable($collection))
        @if (!in_array(gettype($collection), ['array', 'string', 'boolean', 'integer', 'resource', 'null', 'float' ]))
            @if($collection->hasPages())
                <div class="d-flex flex-row justify-content-end mt-3">
                    <div class="ms-3 flex-fill">
                        <small>Showing {{ count($collection) }} of {{ $collection->total() }}  entries</small>
                    </div>
                    <div class="me-3 flex-fill">
                        {{ $collection->links() }}
                    </div>
                </div>
            @else
                <div class="d-flex flex-row justify-content-end mt-3">
                    <div class="ms-3 flex-fill">
                        <small>Showing {{ count($collection) }} of {{ $collection->total() }}  entries</small>
                    </div>
                    <div class="me-3 flex-fill">
                        <nav>
                            <ul class="pagination pagination-sm justify-content-end">
                                <li class="paginate_button page-item previous disabled">
                                    <a href="#" tabindex="0" class="page-link">Previous</a>
                                </li>
                                <li class="paginate_button page-item next disabled">
                                    <a href="#" tabindex="0" class="page-link">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        @endif
    @endif
@endif
