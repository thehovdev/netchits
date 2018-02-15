<?php

namespace App\Models\Friends;

use Illuminate\Database\Eloquent\Model;

class FriendsModel extends Model
{
    protected $table = 'friends';
    protected $guarded = ['id'];
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo('App\Models\Auth\UsersModel', 'friend_id');
    }

    public function follower()
    {
        return $this->belongsTo('App\Models\Auth\UsersModel', 'user_id');
    }


    public function add($user, $friend) {

        $is_friends = $this
            ->where('user_id', $user->id)
            ->where('friend_id', $friend->id)
            ->first();

        if($user->id == $friend->id) {
            $result['status'] = 0;
            $result['msg'] = 'You Cannot follow yourself';
            return $result;
        }


        if(!is_null($is_friends)) {
            $result['status'] = 0;
            $result['msg'] = 'You Already Friends';
            return $result;
        }
        $this->user_id = $user->id;
        $this->friend_id = $friend->id;
        $this->save();

        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;
    }

    public function deleteFriend($user, $friend) {

        $getFriends = $this
            ->where('user_id', $user->id)
            ->where('friend_id', $friend->id)
            ->first();


        if(is_null($getFriends)) {
            $result['status'] = 0;
            $result['msg'] = 'You are not friends';
            return $result;
        }

        $getFriends->delete();

        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;

    }


}
