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

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\UsersModel', 'userid');
    }

    public function group()
    {
        return $this->hasOne('App\Models\User\ChitsGroupModel', 'id', 'group_id');
    }

    // public function userMany() {
    //     return $this->belongsToMany('App\Models\Auth\UsersModel', 'chits_group', 'user_id', 'id');
    // }


    public function hasChits($user) {
        $chits = $this
            ->where('userid', $user['id'])
            ->count();

        return $chits;
    }


    public function deleteFromGroup($user, $chits, $group) {
        foreach ($chits as $chit) {
            $chit->delete();
        }

        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;
    }

    public function copyFromGroup($user, $chits, $group) {




        foreach ($chits as $chit) {
            $insert = new ChitsModel;
            $insert->userid = $user->id;
            $insert->address = $chit->address;
            $insert->group_id = $group->id;
            $insert->opg_sitename = @$chit["opg_site_name"];
            $insert->opg_title = @$chit["opg_title"];
            $insert->opg_image = @$chit["opg_image"];
            $insert->save();
        }



        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;

    }

    public function copy($user, $chitId) {

        $chit = $this->where('id', $chitId)->first();

        // dd($chit);
        // dd($chit['title']);





        $this->userid = $user->id;
        $this->address = $chit->address;
        $this->group_id = '0';
        $this->opg_sitename = @$chit["opg_sitename"];
        $this->opg_title = @$chit["opg_title"];
        $this->opg_image = @$chit["opg_image"];
        $this->save();


        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;
    }

    public function addNew($user, $chitsAddress, $chitsGroupId) {

        // $html = file_get_contents('https://www.youtube.com/watch?v=UuCq8mtK8J4');
        // $dom = new \DomDocument();
        // $ies = libxml_use_internal_errors(true);
        // $dom->loadHTML('<?xml encoding="UTF-8">' . $html);
        // libxml_use_internal_errors($ies);
        // dd($dom);


        $graph = OpenGraph::fetch($chitsAddress);
        $opg = [];

        if(is_youtube($chitsAddress) !== 'yes') {
            foreach ($graph as $key => $value) {
                $opg[$key] = $value;
            }
        } else {

            // FOR YOUTUBE

            $videoId = getcode_youtube($chitsAddress);
            $tags = get_meta_tags('https://www.youtube.com/watch?v=' . $videoId);

            $opg["site_name"] = 'youtube';
            $opg['title'] = $tags['title'];
            $opg['image'] = "//img.youtube.com/vi/" . getcode_youtube($chitsAddress) . "/mqdefault.jpg";
        }


        // insert to database
        $this->userid = $user['id'];
        $this->address = $chitsAddress;
        $this->group_id = $chitsGroupId;
        $this->opg_sitename = @$opg["site_name"];
        $this->opg_title = @$opg["title"];
        $this->opg_image = @$opg["image"];
        $this->save();


        return $this;
    }

    public function remove($user, $chitsId) {

        $userChits = $this
            ->where('userid', $user['id'])
            ->where('id', $chitsId)
            ->first();

        $this
            ->where('userid', $user['id'])
            ->where('id', $chitsId)
            ->delete();

        return $userChits;
    }






    public function getUserChits($user) {
        $userChits = $this->where([
            ['userid', '=', $user['id']],
        ])->latest()->get();

        return $userChits;
    }

    public function getChitsByGroup($user, $id) {
        $chitsByGroup = $this->where([
            ['userid', '=', $user['id']],
            ['group_id', '=', $id],
        ])->get();

        return $chitsByGroup;
    }

    public function getUserChitsByGroup($user, $userGroups) {

        $userChits = [];
        $userChitArr = [];
        foreach ($userGroups as $userGroup) {
            $userChits[$userGroup['name']] = $this->where([
                ['userid', '=', $user['id']],
                ['group_id', '=', $userGroup['id']],
            ])->get();

            foreach ($userChits[$userGroup['name']] as $userChit) {
                $userChitArr[$userChit->id]['id'] = $userChit->id;
                $userChitArr[$userChit->id]['user_id'] = $userChit->userid;
                $userChitArr[$userChit->id]['group_id'] = $userChit->group_id;
                $userChitArr[$userChit->id]['opg_sitename'] = $userChit->opg_sitename;
                $userChitArr[$userChit->id]['opg_title'] = $userChit->opg_title;
                $userChitArr[$userChit->id]['opg_image'] = $userChit->opg_image;
            }
        }

        return $userChitArr;
    }

    public function has_default_chits($user) {

        $userChits = $this->where([
            ['userid', '=', $user['id']],
            ['group_id', '=', 0]
        ])->first();

        if(is_null($userChits)) {
            return false;
        }

        return true;
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
