<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Genre;
use App\Models\Payment;
use App\Models\Store;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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

        // ユーザーが認証済の場合、ユーザー登録情報から個別のおすすめ商品を提案
        $recommend_products = null;
        if (Auth::guard('users')->check()) {
            $user = User::findOrFail(Auth::id(), ['id', 'prefecture', 'city']);
            $genres = $user->genres()->orderBy('id')->get(['id', 'name']);

            // おすすめ商品の検索
            if (!empty($user->prefecture) && $genres->count() > 0) {
                $recommend_products = Product::StoreAddressFilter($user->prefecture, $user->city)->GenresFilter($genres->pluck('id')->toArray())->latest()->take($display_count)->get();
            } elseif (!empty($user->prefecture)) {
                $recommend_products = Product::StoreAddressFilter($user->prefecture, $user->city)->latest()->take($display_count)->get();
            } elseif ($genres->count() > 0) {
                $recommend_products = Product::GenresFilter($genres->pluck('id')->toArray())->latest()->take($display_count)->get();
            }
        }

        //$tests = Store::withAvg('Posts', 'eva_average')->orderByDesc('posts_avg_eva_average')->take($display_count)->get();
        return view('index', compact('browser', 'genres', 'payments', 'latests', 'evaluations', 'bookmarks', 'recommend_products'));
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
        $user_id  = Auth::id();
        $store_id = $request->id;

        $products_count    = 3;
        $storeimages_count = 0;
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $storeimages_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $products_count    = 4;
            $storeimages_count = 8;
        } else {
            $storeimages_count = 18;
        }

        $store = Store::with([
                'products' => function($query) use($products_count) {
                    $query->latest()->limit($products_count);
                },
                'accesses' => function($query) {
                    $query->orderBy('walking_time');
                },
                'storeimages' => function($query) use($storeimages_count) {
                    $query->latest()->limit($storeimages_count);
                },
                'posts' => function($query) {
                    $query->latest()->limit(3);
                },
                'payments',
                'holidays:store_id,sunday,monday,tuesday,wednesday,thursday,friday,saturday',
            ])
            ->findOrFail($store_id);

        // user_idとstore_idからpostsのidを取得
        $post_id = '';
        if (!is_null($user_id) && !is_null($store_id)) {
            // 1つの店舗に対して各ユーザーにつき1投稿まで
            $post = Post::where('user_id', $user_id)
                ->where('store_id', $store_id)
                ->select('id')
                ->first();

            $post_id = (!empty($post)) ? $post->id : '';
        }

        return view('storedetail', compact('store', 'post_id'));
    }

    /**
     * サブスク詳細画面
     * トップページからサブスクを選択された時
     */
    public function productdetail(Request $request)
    {
        $user_id    = Auth::id();
        $product_id = $request->id;

        $category = [];
        if (!is_null($user_id) && !is_null($product_id)) {
            $category = DB::table('product_user')
                ->where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->pluck('category')
                ->toArray();
        }

        $product = Product::with(['store:id,name', 'coupons', 'genres:name'])->findOrFail($product_id);

        return view('productdetail', compact('category', 'product'));
    }
}
