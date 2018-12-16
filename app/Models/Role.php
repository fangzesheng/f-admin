<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\AdminRoleInterface;
use App\Models\Traits\AdminRoleTrait;
use Illuminate\Support\Facades\DB;

class Role extends Model implements AdminRoleInterface
{
    use AdminRoleTrait;
    protected $table = 'admin_roles';
    public function isAbleDel($roleid){
        return DB::table('admin_role_user')->where('role_id',$roleid)->get()->toArray()?true:false;
    }
}
