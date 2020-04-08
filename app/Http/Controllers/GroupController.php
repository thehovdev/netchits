<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = auth()->user()->groups()->create(['name' => $request->name]);

        return response()->json([
            'status' => 1,
            'group' => $group,
            'html' => view('components.default-group', compact('group'))->render(),
            'message' => 'Group successfully has been created!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json([
            'status' => 1,
            'id' => $group->id,
            'message' => 'You have successfully deleted a group'
        ]);
    }
}
