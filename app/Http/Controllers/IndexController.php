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
        // ブラウザがsafariの場合のみアクセス元のブラウザを取得(SPは除外)
        $browser = is_tablet_pc_safari() ? 'safari' : '';

        $display_count = 0;
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
        $evaluations = Store::addSelect(['total_eva_avg' => Post::select(DB::raw('AVG(eva_average)'))->whereColumn('store_id', 'stores.id')->groupBy('store_id')])->orderByDesc('total_eva_avg')->take($display_count)->get();
        $bookmarks = Product::withCount('bookmarkUsers')->orderByDesc('bookmark_users_count')->take($display_count)->get();

        //$tests = Store::withAvg('Posts', 'eva_average')->orderByDesc('posts_avg_eva_average')->take($display_count)->get();
        return view('index', compact('browser', 'genres', 'payments', 'latests', 'evaluations', 'bookmarks'));
    }

    /**
     * 最新店舗一覧表示
     * トップページの店舗最新順表示からもっと見るを選択したとき
     */
    public function latests()
    {
        $display_count = 0;
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 12;
        } else {
            $display_count = 18;
        }

        $latests = Store::latest()->Paginate($display_count)->withQueryString();

        return view('latests', compact('latests'));
    }

    /**
     * 評価の高い店舗一覧表示
     * トップページの評価の高い店舗順表示からもっと見るを選択したとき
     */
    public function evaluations()
    {
        $display_count = 0;
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 12;
        } else {
            $display_count = 18;
        }

        $evaluations = Store::addSelect(['total_eva_avg' => Post::select(DB::raw('AVG(eva_average)'))->whereColumn('store_id', 'stores.id')->groupBy('store_id')])->orderByDesc('total_eva_avg')->Paginate($display_count)->withQueryString();

        return view('evaluations', compact('evaluations'));
    }

    /**
     * 注目されているサブスク一覧表示
     * トップページの注目されているサブスク順表示からもっと見るを選択したとき
     */
    public function bookmarks()
    {
        $display_count = 0;
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 12;
        } else {
            $display_count = 18;
        }

        $bookmarks = Product::withCount('bookmarkUsers')->orderByDesc('bookmark_users_count')->Paginate($display_count)->withQueryString();

        return view('bookmarks', compact('bookmarks'));
    }

    /**
     * 店舗詳細画面
     * トップページから店舗を選択された時
     */
    public function storedetail(Request $request)
    {
        $store = Store::with(['products', 'holidays', 'accesses', 'storeimages', 'posts', 'payments'])->findOrFail($request->id);

        dd('storedetail', $request, 'store', $store); // 開発時に消す
    }

    /**
     * サブスク詳細画面
     * トップページからサブスクを選択された時
     */
    public function productdetail(Request $request)
    {
        $product = Product::with(['store', 'coupons', 'genres'])->findOrFail($request->id);

        dd('productdetail', $request, 'product', $product); // 開発時に消す
    }
}
