<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;
use App\Models\Payment;
use App\Models\Store;
use App\Models\Post;
use App\Models\Product;

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

        $genres   = Genre::get(['id', 'name']);
        $payments = Payment::get(['id', 'method']);

        $latests = Store::latest()->take($display_count)->get();
        $evaluations = Store::withAvg('Posts', 'eva_average')->orderByDesc('posts_avg_eva_average')->take($display_count)->get();
        $bookmarks = Product::withCount('bookmarkUsers')->orderByDesc('bookmark_users_count')->take($display_count)->get();

        return view('index', compact('genres', 'payments', 'latests', 'evaluations', 'bookmarks'));
    }

    /**
     * 最新店舗一覧表示
     * トップページの店舗最新順表示からすべて見るを選択したとき
     *
     * @return array $latests
     */
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
        
        return view('latests', compact('latests'));
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

        $evaluations = Store::withAvg('Posts', 'eva_average')->orderByDesc('posts_avg_eva_average')->Paginate($display_count);
        //return view();
    }

    public function bookmarks()
    {
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 12;
        } else {
            $display_count = 18;
        }

        $bookmarks = Product::withCount('bookmarkUsers')->orderByDesc('bookmark_users_count')->Paginate($display_count);
        //return view();
    }

    /**
     * 店舗詳細画面
     * トップページから店舗を選択された時
     */
    public function storedetail(Request $request)
    {
        dd($request); // 開発時に消す
    }
}
