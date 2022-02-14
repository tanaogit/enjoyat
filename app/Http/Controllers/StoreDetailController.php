<?php

namespace App\Http\Controllers;

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

        // 店舗に基づく写真を最新順に取得
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
}
