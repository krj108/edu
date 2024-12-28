@extends('subjects::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('subjects.name') !!}</p>
@endsection
