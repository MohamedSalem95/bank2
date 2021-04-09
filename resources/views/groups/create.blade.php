@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h2> Create New Group </h2>
            <div class="bg-light border-radius-10 p-3">
            
                <form action="{{ route('groups.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name"> Group Name: </label>
                        <input
                        type="text" 
                        name="name" 
                        id="name"
                        placeholder="Group Name .."
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        >
                        @foreach($errors->get('name') as $error)
                            <b class="text-danger"> {{ $error }} </b>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="company"> Company: </label>

                        <select name="company" 
                        id="company" 
                        class="form-control @error('company') is-invalid @enderror"
                        value="{{ old('company') }}">

                            <option value=""> -- select company -- </option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" @if(old('company') == $company->id) selected @endif> {{ $company->name }} </option>
                            @endforeach

                        </select>
                        @foreach($errors->get('company') as $error)
                            <b class="text-danger"> {{ $error }} </b>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="status"> Status: </label>
                        <select 
                        name="status" 
                        id="status" 
                        class="form-control @error('status') is-invalid @enderror"
                        
                        >
                            <option value=""> -- select status -- </option>
                            <option value="active" @if(old('status') == 'active') selected @endif> active </option>
                            <option value="inactive" @if(old('status') == 'inactive') selected @endif> inactive </option>
                        </select>

                        @foreach($errors->get('status') as $error)
                            <b class="text-danger"> {{ $error }} </b>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save group
                    </button>

                </form>
            </div>
        </div>
    </div>

@stop