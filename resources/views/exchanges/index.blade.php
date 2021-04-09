@extends('layouts.app')


@section('content')
    <h2> All Exchanges </h2>
    <a href="{{ route('exchanges.create') }}" class="font-weight-bold mb-2">
        <i class="fas fa-plus-circle"></i> Create New Exchange
    </a>
    <table class="table table-sm table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th> From </th>
                <th> To </th>
                <th> Rate </th>
                <th> Sell </th>
                <th> Sell Margin </th>
                <th> Buy </th>
                <th> Buy Margin </th>
                <th> Action </th>
            </tr>
        </thead>

        <tbody>
            @forelse($exchanges as $exchange)
                <tr>
                    <td> <b> {{ $exchange->from }} </b> </td>
                    <td> {{ $exchange->to }} </td>
                    <td> <b> {{ $exchange->rate }} </b> </td>
                    <td> <b> {{ $exchange->sell }} </b> </td>
                    <td> <b> {{ $exchange->sell_margin }} </b> </td>
                    <td> <b> {{ $exchange->buy }} </b> </td>
                    <td> <b> {{ $exchange->buy_margin }} </b> </td>
                    <td>
                        <a href="{{ route('exchanges.edit', ['exchange' => $exchange->id]) }}"> <i class="fas fa-edit"></i>Edit </a>
                        <form class="d-inline" action="{{ route('exchanges.destroy', ['exchange' => $exchange->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button 
                            type="submit" 
                            class="btn btn-outline-danger btn-sm"
                            onClick="return confirm('Are you sure?')"
                            > <i class="fas fa-trash-alt"></i> Delete </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <p class="text-center">
                            <b class="text-muted"> No Data Here 🐠 </b>
                        </p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $exchanges->links('pagination::bootstrap-4') }}
        
    
@stop