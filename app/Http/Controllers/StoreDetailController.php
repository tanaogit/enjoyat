<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterPostRequest;
use App\Models\Post;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreDetailController extends Controller
{
    /**
     * 店舗に紐づく写真をすべて表示
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

    /**
     * 口コミ投稿画面
     * 店舗詳細における「口コミを投稿する」ボタンクリック時
     */
    public function createPost(Request $request)
    {
        $user_id  = $request->user_id;
        $store_id = $request->store_id;

        if (Auth::id() !== (int)$user_id) {
            abort(403);
        }

        $store = Store::select('id', 'name')->findOrFail($store_id);

        $post = Post::where('user_id', $user_id)
            ->where('store_id', $store_id)
            ->select('id')
            ->first();

        // すでに投稿済みの場合は403へ
        if (!empty($post)) {
            abort(403);
        }

        return view('storedetail.create-post', compact('store'));
    }

    /**
     * 口コミ登録処理
     * 口コミ投稿ページから口コミを投稿した時
     */
    public function registerPost(RegisterPostRequest $request)
    {
        $insertRecord = $request->validated();
        $insertRecord['eva_average'] = $request->eva_average;

        try {
            $record = Post::create($insertRecord);
            return redirect()->route('index.storedetail', ['id' => $record->store_id])->with('status', 'success');
        } catch(\Exception $e) {
            abort(500);
        }
    }

    /**
     * 口コミ登録処理(ajax)
     * 店舗詳細における口コミ投稿ダイアログから口コミを投稿した時
     */
    public function registerPostAjax(RegisterPostRequest $request)
    {
        $insertRecord = $request->validated();
        $insertRecord['eva_average'] = $request->eva_average;

        try {
            Post::create($insertRecord);
            return response()->json(['type' => 'success']);
        } catch(\Exception $e) {
            return response()->json(['type' => 'fail']);
        }
    }

    /**
     * 店舗に紐づくサブスクをすべて表示
     * 店舗詳細における最新のサブスクについて「すべて見る」を選択した時
     */
    public function products(Request $request)
    {
        $store_id = $request->id;

        // 1ページあたりのサブスクの最大件数
        $products_count = 18;
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $products_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $products_count = 12;
        }

        // 店舗の情報を取得
        $store = Store::select('id', 'name')->findOrFail($store_id);

        // 店舗に紐づくサブスクを最新順に取得
        $products = Product::where('store_id', $store_id)
            ->latest()
            ->paginate($products_count, ['id', 'name', 'price', 'unitprice', 'image'])
            ->withQueryString();

        // 最後のページよりも大きい値が指定されたときは404に飛ばす
        if ($products->currentPage() > $products->lastPage()) {
            abort(404);
        }

        return view('storedetail.products', compact('store', 'products'));
    }
}
