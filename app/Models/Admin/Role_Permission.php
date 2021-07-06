<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_Permission extends Model
{
    use HasFactory;
    protected $table = 'role_permission';

    public function getRolePermissionById($role_id){
        $rolepermission = Role_Permission::where(['role_id'=>$role_id])->first();
        return $rolepermission;
    }
}
