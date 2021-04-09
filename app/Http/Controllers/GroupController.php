<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;

class GroupController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $groups = Group::latest()->paginate(15);
        $group_count = Group::count();
        return view('groups.index', ['groups' => $groups, 'group_count' => $group_count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $companies = Company::all();
        return view('groups.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request) {
        $company = Company::find($request->company);
        $company->groups()->create([
            'name' => $request->name,
            'status' => $request->status,
            'user_id' => $request->user()->id
        ]);

        return redirect(route('groups.index'))->with('success', 'Group Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group) {
        $companies = Company::all();
        return view('groups.edit', ['group' => $group, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group) {
        $group->update($request->all());
        return redirect(route('groups.index'))->with('success', 'Updated Group Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group) {
        //
    }
}
