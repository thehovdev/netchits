<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chit extends Model
{
    protected $fillable = [
        'group_id', 'address', 'title', 'image'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
