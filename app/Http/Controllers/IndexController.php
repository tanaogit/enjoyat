<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class IndexController extends Controller
{
    public function index()
    {
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 3;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } else {
            $display_count = 9;
        }

        $latests = Store::orderBy('created_at', 'desc')->simplePaginate($display_count);
        return view('index', compact($latests));
    }
}
