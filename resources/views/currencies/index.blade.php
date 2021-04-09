@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <p class="h4"> All Currencies. </p>
            <a href="{{ route('currencies.create') }}">
                <b>
                <i class="fas fa-plus-circle"></i>
                Create New Currency
                </b>
            </a>
            <table class='table table-striped table-sm table-hover table-bordered'>
                <thead>
                    <th> Iso </th>
                    <th> Name </th>
                    <th> Actions </th>
                </thead>

                <tbody>
                    @forelse($currencies as $currency)
                        <tr> 
                            <td> {{ $currency->iso }} </td>
                            <td> {{ $currency->name }} </td>
                            <td>
                                <a href="{{ route('currencies.edit', ['currency' => $currency->id]) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('currencies.destroy', ['currency' => $currency->id]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onClick="return confirm('Are you sure?')" type="submit" class="btn btn-sm btn-outline-danger"> <i class="fas fa-trash-alt"></i> Delete </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3">
                                <p class="text-muted text-center"> <b> No currencies here yet.. </b> </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <p class="text-right"> {{ $currencies->links('pagination::bootstrap-4') }} </p>
        </div>
    </div>
@stop