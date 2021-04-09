@extends('layouts.app')

@section('content')
    <h2> Group Master </h2>
    <a href="{{ route('groups.create') }}">
        <b>
        <i class="fas fa-plus-circle"></i> Create new group
        </b>
    </a>
    <p>
        <b class="text-muted">
            Total of {{ $group_count }} {{ Str::plural('group', $group_count) }}
        </b>
    </p>
    <table class="table table-striped table-sm table-hover table-bordered">

        <thead>
            <tr>

                <th> Name </th>
                <th> Company </th>
                <th> Status </th>
                <th> Actions </th>
            </tr>
        </thead>

        <tbody>
        @forelse($groups as $group)
            <tr>
                <td> {{ $group->name }} </td>
                <td> <b class=""> {{ $group->company->name }} </b> </td>
                <td class="@if($group->status == 'inactive') text-danger @else text-success @endif font-weight-bold"> {{ $group->status }} </td>
                <td>
                    <a href="{{ route('groups.edit', ['group' => $group->id]) }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </td>

            </tr>
        @empty

            <tr>
                <td colspan="4">
                  <p class="text-center">
                  <b class="text-muted">  No groups Here yet.. 
                    you can may create a new one <a href="{{ route('groups.create') }}"> Here </a>  </b>
                  </p> 
                </td>
            </tr>

        @endforelse
        </tbody>

    </table>

    {{ $groups->links('pagination::bootstrap-4') }}

   

@stop