@extends('errors.master')

@section('misc-content')
<h2 class="mb-2 mx-2">Forbidden Page :(</h2>
<p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
<a href="javascript:history.back()" class="btn btn-primary">Back to home</a>
<div class="mt-3">
    <img src="{{ asset('/assets/img/illustrations/access_forbidden.png') }}" alt="403 Forbidden Page" width="500" class="img-fluid"/>
</div>
@endsection
