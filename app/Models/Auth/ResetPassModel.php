<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class ResetPassModel extends Model
{
    protected $table = 'reset_pass';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function addCode($data) {
        // проверяем есть ли старый код
        $code = $this
            ->where('code', $data['resetCode'])
            ->where('user_id', $data['user_id'])
            ->first();
        // если есть удаляем, чтобы записать новый
        if(!is_null($code)) {
            $code = $this
                ->where('code', $data['resetCode'])
                ->where('user_id', $data['user_id'])
                ->delete();
        }


        $this->email = $data['userEmail'];
        $this->code = $data['resetCode'];
        $this->user_id = $data['user_id'];
        $this->save();
        return $this;
    }

    public function checkCode($code, $id) {
        $code = $this
            ->where('code', $code)
            ->where('user_id', $id)
            ->first();

        if(!is_null($code)) {
            $result['status'] = 1;
            $result['msg'] = 'code and user equals';
        } else {
            $result['status'] = 0;
            $result['msg'] = 'error code not exists';
        }

        return $result;
    }

}
