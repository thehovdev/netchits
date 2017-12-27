<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

use App\Http\Lib\OpenGraph;
use App\Http\Controllers\Api\Data\DataController;


class ChitsModel extends Model
{
    protected $table = 'chits';
    protected $guarded = ['id'];
    public $timestamps = true;
    public $result = [];

    public function addNew($user, $chitsAddress) {

        $graph = OpenGraph::fetch($chitsAddress);
        $opg = [];

        if(is_youtube($chitsAddress) !== 'yes') {
            foreach ($graph as $key => $value) {
                $opg[$key] = $value;
            }
        }  else {
            foreach ($graph as $key => $value) {
                $opg[$key] = "null";
            }
        }


        // insert to database
        $this->userid = $user['id'];
        $this->address = $chitsAddress;
        $this->opg_sitename = @$opg["site_name"];
        $this->opg_title = @$opg["title"];
        $this->opg_image = @$opg["image"];
        $this->save();

        // return result
        $this->result['status'] = 1;
        $this->result['msg'] = 'success';
        $this->result['chitsAddress'] = $chitsAddress;

        return $this->result;
    }

    public function remove($user, $chitsId) {

        $userChits = $this->where([
            ['userid', '=', $user['id']],
            ['id', '=', $chitsId]
        ])->delete();

        $this->result['status'] = 1;
        $this->result['msg'] = 'success';
        return $this->result;

    }

    public function getUserChits($user) {

        $userChits = $this->where([
            ['userid', '=', $user['id']],
        ])->get();

        return $userChits;
    }

    public function is_userchits($user, $chitsId) {

        $userChits = $this->where([
            ['userid', '=', $user['id']],
            ['id', '=', $chitsId]
        ])->first();

        if(is_null($userChits)) {
            $this->result['status'] = 0;
            $this->result['msg'] = 'post with this id and userid not found';
            return $this->result;
        }


        $this->result['status'] = 1;
        $this->result['msg'] = 'success';
        return $this->result;

    }


}
