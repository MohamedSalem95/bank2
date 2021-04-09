@extends('layouts.app')


@section('content')
    <div class="row">

        <div class="col">
            <h2> Create New Company </h2>
            <div class="bg-light border-radius-10 p-3">
            
        <form action="{{ route('companies.store') }}" method="post">

            @csrf

            <div class="form-group">
                <label for="name"> Name: </label>
                <input 
                type="text" 
                name="name" 
                id="name" 
                placeholder="name here...." 
                class="form-control @error('name')) is-invalid @enderror"
                value="{{ old('name') }}">

                @foreach($errors->get('name') as $error)
                        <b class="text-danger"> {{ $error }} </b>
                @endforeach
            </div>

            <div class="form-group">
                <label for="person"> Contact Person: </label>
                <input 
                type="text" 
                name="contact_person" 
                id="person" 
                placeholder="contact person here...." 
                class="form-control @error('contact_person')) is-invalid @enderror"
                value="{{ old('contact_person') }}">

                @foreach($errors->get('contact_person') as $error)
                        <b class="text-danger"> {{ $error }} </b>
                @endforeach
            </div>

            <div class="form-group">
                <label for="number"> Contact Number: </label>
                <input 
                type="text" 
                name="contact_name" 
                id="number" 
                placeholder="contact Number here...." 
                class="form-control @error('contact_name') is-invalid @enderror"
                value="{{ old('contact_name') }}">

                @foreach($errors->get('contact_name') as $error)
                        <b class="text-danger"> {{ $error }} </b>
                @endforeach
            </div>

            <div class="form-group">
                <label for="address"> Address: </label>
                <input 
                type="text" 
                name="address" 
                id="address" 
                placeholder="address here...." 
                class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address') }}">
                @foreach($errors->get('address') as $error)
                        <b class="text-danger"> {{ $error }} </b>
                @endforeach
                
        </div> 

        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i>    Save Company 
        </button>
    
    </form>

            </div>

        </div>

    </div>
@stop