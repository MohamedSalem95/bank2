@extends('layouts.app')

@section('content')
    <h2> Edit Exchange </h2>
    <edit-exchange-component :id="{{ $exchange->id }}"></edit-exchange-component>
@stop