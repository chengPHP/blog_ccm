<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public function scopeStatus($query,$status = 0)
    {
        return $query->where('status', '>=', $status);
    }

    public static function getSpaceTreeData()
    {
        $data = self::status()->get()->toArray();
        return formatTreeData($data,'id','pid');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
}
