<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Store;
use App\Models\Post;

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

        $latests = Store::latest()->take($display_count)->get();
        $evaluations = Store::addSelect(['total_eva_avg' => Post::select(DB::raw('AVG(eva_average)'))->whereColumn('store_id', 'stores.id')->groupBy('store_id')])->orderByDesc('total_eva_avg')->take($display_count)->get();
        return view('index', compact('latests', 'evaluations'));
    }

    public function latests()
    {
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 12;
        } else {
            $display_count = 18;
        }

        $latests = Store::latest()->Paginate($display_count);
        //return view();
    }

    public function evaluations()
    {
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 12;
        } else {
            $display_count = 18;
        }

        $evaluations = Store::addSelect(['total_eva_avg' => Post::select(DB::raw('AVG(eva_average)'))->whereColumn('store_id', 'stores.id')->groupBy('store_id')])->orderByDesc('total_eva_avg')->Paginate($display_count);
        //return view();
    }

    public function bookmarks()
    {
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 3;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } else {
            $display_count = 9;
        }

        //return view();
    }
}
