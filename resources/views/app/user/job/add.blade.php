@extends('template')

@section('container')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.job.store') }}">
        {{ csrf_field() }}
        @include('app.user.job._form')
    </form>
@endsection