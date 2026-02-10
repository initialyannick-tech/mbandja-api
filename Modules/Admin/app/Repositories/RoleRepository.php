<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Models\Permission;
use Modules\Admin\Models\Role;
use Modules\Admin\Models\User;
use Modules\Admin\Transformers\RoleResource;

class RoleRepository
{
    public function paginate()
    {
        $roles = Role::paginate(12);
        return RoleResource::collection($roles);
    }
   
   
    public function liste()
    {
        $roles = Role::all();
        return RoleResource::collection($roles);
    }

    public function store($data)
    {
        $permissions = $data['permissions'];
        $role = new Role;
        $role->fill($data);
        if($role->save()){
            $role->permissions()->sync($permissions);
            return $role;
        }
        return false;
    }

    public function update($data, $id)
    {
        $permissions = $data['permissions'];
        $role = Role::whereId($id)->first();
        $role->fill($data);
        if($role->save()){
            $role->permissions()->sync($permissions);
            return $role;
        }
        return false;
    }

    public function destroy($id)
    {
        $users = User::where('role_id', $id)->count();
        if($users > 0){
            return false;
        } else {
            $role = Role::find($id);
            if($role->delete()){
                return true;
            }
        }
    }


    public function permissions()
    {
        return Permission::all();
    }
}
