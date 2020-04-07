<?php

namespace App\Http\Controllers;

use OpenGraph;

use App\Chit;

use App\Services\FetchMetaData;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

class ChitController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $data = OpenGraph::fetch($request->address);

        $group = $user->groups()->firstOrCreate(['id' => $request->groupId], ['name' => 'Default']);
        
        $data['title'] = $data['title'] ?? (new FetchMetaData($request->address))->getTitle();
        
        $chit = $user->chits()->create([
            'group_id' => $group->id,
            'address' => $request->address,
            'title' => $data['title'],
            'image' => $data['image'] ?? 'images/web.png'
        ]);

        $view = Str::contains($request->address, 'youtube') ? 'components.video-chit' : 'components.default-chit';
            
        return response()->json([
            'status' => 1,
            'groupId' => $group->id,
            'html' => view($view, compact('chit'))->render()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chit  $chit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chit $chit)
    {
        $chit->delete();

        return response()->json([
            'id' => $chit->id,
            'message' => 'Successfully deleted!'
        ]);
    }
}
