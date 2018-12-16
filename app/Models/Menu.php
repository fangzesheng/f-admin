<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\AdminMenuInterface;
use App\Models\Traits\AdminMenuTrait;
class Menu extends Model implements AdminMenuInterface
{
    use AdminMenuTrait;

    protected $table = 'admin_menus';

    protected $primaryKey = 'id';

    protected static $branchOrder = [];

}
