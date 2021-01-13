<?php

namespace App\Traits;

use App\Models\Maintenance\PermissionsModel;
use App\Models\Maintenance\RolesModel;

trait UserTrait
{

    public function rol()
    {

    }

    public function havePermission($permission_route, $user)
    {
        $permissions = PermissionsModel::join('menus', 'menus.id', '=', 'permissions.menu_id')
            ->where('role_id', '=', $user->role_id)
            ->where('status', '=', 'available')
            ->select('permissions.*', 'menus.link as route')
            ->get();

        foreach ($permissions as $permission) {
            if ($permission->route === $permission_route) {
                return true;
            } else {
                return false;
            }
        }

    }
}

?>
