<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Store;
use App\Models\StoreImage;
use Illuminate\Http\Request;

class StoreDetailController extends Controller
{
    /**
     * 店舗に紐づく画像をすべて表示
     * 店舗詳細における写真について「すべて見る」を選択した時
     */
    public function storeimages(Request $request)
    {
        $store_id = $request->id;
        $category = $request->category;

        // categoryが指定のもの以外の場合404に飛ばす
        if (!is_null($category) && !StoreImage::inCategoryArray($category)) {
            abort(404);
        }

        // 1ページあたりの写真の最大枚数
        $storeimages_count = 24;
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $storeimages_count = 12;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $storeimages_count = 16;
        }

        // 店舗の情報を取得
        $store = Store::select('id', 'name')->findOrFail($store_id);

        // 店舗に紐づく写真を最新順に取得
        $storeimages = StoreImage::where('store_id', $store_id)
            ->when(!is_null($category), function($query) use($category) {
                return $query->where('category', $category);
            })
            ->latest()
            ->paginate($storeimages_count)
            ->withQueryString();

        // 最後のページよりも大きい値が指定されたときは404に飛ばす
        if ($storeimages->currentPage() > $storeimages->lastPage()) {
            abort(404);
        }

        return view('storedetail.storeimages', compact('category', 'store', 'storeimages'));
    }

    /**
     * 店舗に紐づく口コミをすべて表示
     * 店舗詳細における口コミについて「すべて見る」を選択した時
     */
    public function posts(Request $request)
    {
        $store_id = $request->id;

        // 1ページあたりの口コミの最大件数
        $posts_count = 14;
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $posts_count = 10;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $posts_count = 12;
        }

        // 店舗の情報を取得
        $store = Store::select('id', 'name')->findOrFail($store_id);

        // 店舗に紐づく口コミを最新順に取得
        $posts = Post::where('store_id', $store_id)
            ->latest()
            ->paginate($posts_count, ['title', 'message', 'evaluation1', 'evaluation2', 'evaluation3', 'evaluation4', 'evaluation5', 'eva_average', 'created_at'])
            ->withQueryString();

        // 最後のページよりも大きい値が指定されたときは404に飛ばす
        if ($posts->currentPage() > $posts->lastPage()) {
            abort(404);
        }

        return view('storedetail.posts', compact('store', 'posts'));
    }
}
