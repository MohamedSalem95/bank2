@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h4> Create New Currency </h4>
            <div class="bg-light border-radius-10 p-3">
                <form action="{{ route('currencies.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="iso"> Iso: </label>
                        <input 
                        type="text"
                        name="iso"
                        id="iso"
                        class="form-control @error('iso') is-invalid @enderror"
                        placeholder="Enter currency iso.."
                        value="{{ old('iso') }}">
                        @foreach($errors->get('iso') as $error)
                            <div>
                                <strong class="text-danger"> {{ $error }} </strong>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="name"> Name: </label>
                        <input 
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter currency name.."
                        value="{{ old('name') }}">

                        @foreach($errors->get('name') as $error)
                            <div>
                                <strong class="text-danger"> {{ $error }} </strong>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Currency
                    </button>
                </form>
            </div>  
        </div>
    </div>
@stop