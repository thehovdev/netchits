<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class ChitsGroupModel extends Model
{
    protected $table = 'chits_group';
    protected $guarded = ['id'];
    public $timestamps = true;
    public $result = [];

    // relations

    public function chits()
    {
        return $this->hasMany('App\Models\User\ChitsModel', 'group_id');
    }
    

    public function copyGroup($user, $group) {
        $this->user_id = $user->id;
        $this->name = $group->name;
        $this->save();
        return $this;
    }


    public function addGroup($chitsGroup, $user) {

        // insert to database
        $this->user_id = $user['id'];
        $this->name = $chitsGroup;
        $this->save();

        // return result
        $this->result['status'] = 1;
        $this->result['msg'] = 'success';
        $this->result['chitsGroup'] = $chitsGroup;

        return $this->result;
    }

    public function remove($user, $groupId) {

        // dd($groupId);
        // dd($user->id);

        $userGroups = $this->where([
            ['user_id', '=', $user->id],
            ['id', '=', $groupId]
        ])->delete();


        $this->result['status'] = 1;
        $this->result['msg'] = 'success';
        return $this->result;
    }


    public function getUserGroups($user) {

        $userGroups = $this->where([
            ['user_id', '=', $user['id']],
        ])->get();

        // return $userGroups;

        $groups = [];
        foreach ($userGroups as $userGroup) {
            $groups[$userGroup->name]['id'] = $userGroup->id;
            $groups[$userGroup->name]['user_id'] = $userGroup->user_id;
            $groups[$userGroup->name]['name'] = $userGroup->name;
            $groups[$userGroup->name]['chits'] = "test";

        }

        return $groups;
    }


    public function is_usergroup($user, $groupId) {

        // dd($user);
        // dd($groupId);


        $userGroup = $this->where([
            ['user_id', '=', $user['id']],
            ['id', '=', $groupId]
        ])->first();


        if(is_null($userGroup)) {
            $this->result['status'] = 0;
            $this->result['msg'] = 'group with this id and userid not found';
            return $this->result;
        }


        $this->result['status'] = 1;
        $this->result['msg'] = 'success';
        return $this->result;

    }

}
