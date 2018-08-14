<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //
    public function permission()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
}
