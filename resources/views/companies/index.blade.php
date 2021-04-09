@extends('layouts.app')

@section('content')
    <h2> Company Master </h2>

    <b>
        <a href="{{ route('companies.create') }}">
            <i class="fas fa-plus-circle"></i> 
            Create New Company. 
        </a>
    </b>

    <p>
        <b class="text-muted">
            Total of {{ $companies->count() }} {{ Str::plural('company', $companies->count()) }}
        </b>
    </p>
    
    

    <table class="table table-striped table-hover table-sm table-bordered">
        
        <thead>

            <tr>
            
                <th>
                    Name
                </th>

                <th>
                    Contact person
                </th>

                <th>
                
                    Contact number
                </th>

                <th>
                    Address
                </th>

                <th>
                    No of Branches
                </th>

                <th>
                    Action
                </th>
            </tr>
        
        </thead>

        <tbody>

        @forelse ($companies as $company)
        <tr>
            
                <td>
                    {{ $company->name }}
                </td>

                <td>
                    {{ $company->contact_person }}
                </td>

                <td>
                    {{ $company->contact_name }}
                </td>

                <td>
                    {{ $company->address }}
                </td>

                <td>
                    0
                </td>

                <td>
                    <a href="{{ route('companies.edit', ['company' => $company->id]) }}">
                    <i class="fas fa-edit"></i>Edit
                    </a> &nbsp;
                    <form class="d-inline" action="{{ route('companies.destroy', ['company' => $company->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onClick="return confirm('Are you Sure?')"  class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash-alt"></i> Delete
                        </button>

                    </form>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="6">
                    <p class="text-center">
                        <b class="text-muted">
                            No Companies Here Yet.. Please Consider Creating New One

                            <a href="{{ route('companies.create') }}"> Here </a>
                        </b>
                    </p>
                </td>
            </tr>
                
            
        @endforelse
            
        </tbody>
    </table>


   

@stop