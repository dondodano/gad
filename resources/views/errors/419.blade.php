@extends('errors.master')

@section('misc-content')
<h2 class="mb-2 mx-2">Unknown Status</h2>
<p class="mb-4 mx-2">Oops! 😖 419 Unknown Status.</p>
<a href="javascript:history.back()" class="btn btn-primary">Back to home</a>
<div class="mt-3">
    <img src="{{ asset('/assets/img/illustrations/woman-unknown-door.png') }}" alt="419 Unknown Status" width="500" class="img-fluid"/>
</div>
@endsection
