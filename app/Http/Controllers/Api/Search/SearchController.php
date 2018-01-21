<?php

namespace App\Http\Controllers\Api\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
use App\Models\User\ChitsModel;
use App\Models\User\ChitsGroupModel;

class SearchController extends Controller
{
    public function search(Request $request) {
        // SECTION : MODELS
        $usersModel = new UsersModel;

        // SECTION : Requests
        $search = $request->search;

        // SECTION : Logics
        $searchResult = $usersModel->search($search);

        return $searchResult;
        
    }
}
