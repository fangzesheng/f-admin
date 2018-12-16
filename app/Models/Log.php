<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'admin_logs';
    public function user()
    {
        return $this->hasOne(config('auth.providers.users.model'), 'id', 'admin_id');
    }
    public static function addLogs($content,$url,$id = ''){
        if(!$id){
            $admin = new Admin();
            $id = $admin->userId();
        }
        $data = [
            'admin_id'=>$id,
            'log_info'=>$content,
            'log_url'=>$url,
            'log_ip'=>$_SERVER['REMOTE_ADDR'],
            'log_time'=>date('Y-m-d H:i:s',time())
        ];
        Log::insert($data);
    }
}
