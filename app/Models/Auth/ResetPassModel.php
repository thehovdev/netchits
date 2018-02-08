<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class ResetPassModel extends Model
{
    protected $table = 'reset_pass';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function addCode($data) {
        $this->email = $data['userEmail'];
        $this->code = $data['resetCode'];
        $this->save();

        return $this;
    }
}
