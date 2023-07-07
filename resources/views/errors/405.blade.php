@extends('errors.master')

@section('misc-content')
<h2 class="mb-2 mx-2">Method Not Allowed</h2>
<p class="mb-4 mx-2">Oops! 😖 The requested URL is not allowed.</p>
<a href="javascript:history.back()" class="btn btn-primary">Back to home</a>
<div class="mt-3">
    <img src="{{ asset('/assets/img/illustrations/man-not-allowed-access.png') }}" alt="405 Method Not Allowed" width="500" class="img-fluid"/>
</div>
@endsection
