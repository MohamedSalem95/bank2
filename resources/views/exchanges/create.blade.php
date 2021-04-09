@extends('layouts.app')


@section('content')
    <h2> Create exchange </h2>
    <exchange-component></exchange-component>
    <p class="text-center font-weight-bold">
        <a href="{{ route('exchanges.index') }}" class="btn btn-outline-primary"> View All Exchanges </a>

    </p>
@stop