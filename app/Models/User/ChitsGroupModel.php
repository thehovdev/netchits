<?php

namespace NetChits\Models\User;

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
        return $this->hasMany('NetChits\Models\User\ChitsModel', 'group_id');
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
        return $this;
    }

    public function addDefaultGroup($user) {

        // insert to database
        $this->user_id = $user['id'];
        $this->name = 'Default Group';
        $this->save();

        // return result
        return $this;
    }

    public function remove($user, $groupId) {

        $group = $this
            ->where('user_id', $user->id)
            ->where('id', $groupId)
            ->first();
        // есть ли еще группы кроме этой
        $group->hasGroup = $this->hasGroup($user, $groupId);


        $this
            ->where('user_id', $user->id)
            ->where('id', $groupId)
            ->delete();


        return $group;
    }

    public function hasGroup($user, $id) {
        $groups = $this
            ->where('user_id', $user['id'])
            ->where('id', '!=', $id)
            ->count();

        return $groups;
    }

    public function getUserGroups($user) {

        $userGroups = $this
            ->where('user_id', $user['id'])
            ->orderByDesc("id")
            ->get();

        $groups = [];
        foreach ($userGroups as $userGroup) {
            $groups[$userGroup->id]['id'] = $userGroup->id;
            $groups[$userGroup->id]['user_id'] = $userGroup->user_id;
            $groups[$userGroup->id]['name'] = $userGroup->name;
            $groups[$userGroup->id]['chits'] = "test";
        }

        return $groups;
    }

    public function is_usergroup($user, $groupId) {

        $userGroup = $this
            ->where('user_id', $user['id'])
            ->where('id', $groupId)
            ->first();


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
