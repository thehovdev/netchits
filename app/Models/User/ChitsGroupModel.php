<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class ChitsGroupModel extends Model
{
    protected $table = 'chits_group';
    protected $guarded = ['id'];
    public $timestamps = true;
    public $result = [];

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

}
