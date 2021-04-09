@extends('layouts.app')


@section('content')
    <h2> Edit Company </h2>

    <div class="row">
        <div class="col">
            <div class="bg-light p-3 border-radius-10">
            <form action="{{ route('companies.update', ['company' => $company->id]) }}" method="post">

@csrf


<div class="form-group">
    <label for="name"> Name </label>
    <input 
    type="text" 
    name="name" 
    id="name" 
    placeholder="name here...." 
    class="form-control @error('name')) is-invalid @enderror"
    value="{{ old('name', $company->name) }}">

    @foreach($errors->get('name') as $error)
            <b class="text-danger"> {{ $error }} </b>
    @endforeach
</div>

<div class="form-group">
    <label for="person"> Contact Person </label>
    <input 
    type="text" 
    name="contact_person" 
    id="person" 
    placeholder="contact person here...." 
    class="form-control @error('contact_person')) is-invalid @enderror"
    value="{{ old('contact_person', $company->contact_person) }}">

    @foreach($errors->get('contact_person') as $error)
            <b class="text-danger"> {{ $error }} </b>
    @endforeach
</div>

<div class="form-group">
    <label for="number"> Contact Number </label>
    <input 
    type="text" 
    name="contact_name" 
    id="number" 
    placeholder="contact Number here...." 
    class="form-control @error('contact_name') is-invalid @enderror"
    value="{{ old('contact_name', $company->contact_name) }}">

    @foreach($errors->get('contact_name') as $error)
            <b class="text-danger"> {{ $error }} </b>
    @endforeach
</div>

<div class="form-group">
    <label for="address"> Address </label>
    <input 
    type="text" 
    name="address" 
    id="address" 
    placeholder="address here...." 
    class="form-control @error('address') is-invalid @enderror"
    value="{{ old('address', $company->address) }}">
    @foreach($errors->get('address') as $error)
            <b class="text-danger"> {{ $error }} </b>
    @endforeach
    
</div>
@method('PUT')
<button type="submit" class="btn btn-success"> Update Company </button>

</form>
            </div>
        </div>
    </div>

@stop