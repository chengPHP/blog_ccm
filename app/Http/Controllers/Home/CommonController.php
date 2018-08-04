<?php

namespace App\Http\Controllers\Home;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    function __construct()
    {

        $list = Nav::where(['status'=>1])->get()->toArray();
        $navs = list_to_tree($list);
        View::share('navs',$navs);
    }
}
