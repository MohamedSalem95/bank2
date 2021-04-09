@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-1">
            <img src="{{ Identicon::getImageDataUri(Auth::user()->email) }}" alt="">
        </div>
        <div class="col">
        
            <h4> {{ $user->name }} </h4>
            <small class="text-muted"> Joined <b> {{ $user->created_at->diffForHumans() }} </b> </small>
        </div>
    </div>

@stop