<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Interfaces\AdminUsersInterface;
use App\Models\Traits\AdminUsersTrait;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract, AdminUsersInterface
{
    use Authenticatable, CanResetPassword, AdminUsersTrait;
    protected $table = 'admin_users';
    protected $fillable = ['username', 'email', 'mobile', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $userInfo;
}
