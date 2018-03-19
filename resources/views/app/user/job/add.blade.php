@extends('template')

@section('container')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.job.store') }}">
        @include('app.user.job._form')
    </form>
@endsection