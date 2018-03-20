@extends('template')

@section('container')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.job.update', ['job' => $job->id]) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        @include('app.user.job._form')
    </form>
@endsection