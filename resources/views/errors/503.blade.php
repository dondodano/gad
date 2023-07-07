@extends('errors.master')

@section('misc-content')
<h2 class="mb-2 mx-2 text-danger">Under Maintenance!</h2>
<p class="mb-4 mx-2">Sorry for the inconvenience but we're performing some maintenance at the moment</p>
<div class="mt-3">
    <img src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}" alt="503 Under Maintenance" width="500" class="img-fluid"/>
</div>
@endsection
