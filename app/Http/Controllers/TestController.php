<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
use App\Models\User\ChitsModel;
//-------------------App Models---------------------//

use App\Http\Lib\OpenGraph;




class TestController extends Controller
{
    public function test() {


        $graph = OpenGraph::fetch('https://facebook.com');



        // var_dump($graph->keys());
        // var_dump($graph->schema);

        // dd($graph);
        // die();

        $result = [];

        foreach ($graph as $key => $value) {
            $result[$key] = $value;
            // echo "$key => $value" . "<br />";
        }

        return $result;



        //
        // $o = OpenGraph::fetch(
        //   'https://www.facebook.com'
        // );
        //
        // dd($o);
        // die();
        //
        // $this->assertType('OpenGraph', $o);


        // $usersModel = new UsersModel;
        // $chitsModel = new ChitsModel;
        //
        //
        // $user = $usersModel->getUser();
        //
        // $userChits = $chitsModel->getUserChits($user);
        // return $userChits;


        // $time = time() + 604800;
        //
        // setcookie("email", "halilov.lib@gmail.com", time() + 604800);
        //
        //
        // if(isset($_COOKIE["email"])) {
        //     return $_COOKIE["email"];
        // };



        // $dataController = new DataController;
        //
        // $openData = 'exampletext';
        //
        // $encryptedData = $dataController->encryptOpenssl($openData);
        //
        // return $encryptedData;
    }
}
