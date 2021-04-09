@extends('layouts.app')

@section('content')

<h5> Welcome <b class="text-capitalize"> {{ Auth::user()->name }} </b> to Your Dashboard! 🦄 </h5>
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="row">

    <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <p class="card-text h1">
                        {{ $group_count }} {{ Str::plural('Group', $group_count) }}
                    </p>
                </div>
            </div>  
    </div>

    <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <p class="card-text h1">
                        0 Branches
                    </p>
                </div>
            </div>  
    </div>

</div>

@endsection
