<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class IndexController extends Controller
{
    public function index()
    {
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $latest_count = 3;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT']))  {
            $latest_count = 6;
        } else {
            $latest_count = 9;
        }

        $latests = Store::OrderByCreatedAt('desc')->simplePaginate($latest_count);
        return view('index', ['latests' => $latests]);
    }
}
