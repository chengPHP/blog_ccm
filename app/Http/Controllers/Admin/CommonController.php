<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function no_permission($permission)
    {
        if(!Auth::user()->can(config('permissions.'.$permission))){
            return view('admin.500');
        }
    }

}
