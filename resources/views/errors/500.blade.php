@extends('errors.master')

@section('misc-content')
<h2 class="mb-2 mx-2">Server Error</h2>
<p class="mb-4 mx-2">Oops! 😖 500 Server Error.</p>
<a href="javascript:history.back()" class="btn btn-primary">Back to home</a>
<div class="mt-3">
    <img src="{{ asset('/assets/img/illustrations/people-access-error.png') }}" alt="500 Server Error" width="500" class="img-fluid"/>
</div>
@endsection
