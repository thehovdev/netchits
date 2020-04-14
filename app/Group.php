<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chits()
    {
        return $this->hasMany(Chit::class);
    }
}
