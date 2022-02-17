<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductDetailController extends Controller
{
    /**
     * お気に入りボタンの登録・削除処理
     * サブスク詳細におけるお気に入りボタンをクリックした時
     */
    public function executeBookmark(Request $request)
    {
        $user_id    = $request->userId;
        $product_id = $request->productId;

        $category = DB::table('product_user')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->pluck('category')
            ->toArray();

        if (empty($category)) {
            DB::table('product_user')
                ->insert([
                    'user_id'    => $user_id,
                    'product_id' => $product_id,
                    'category'   => 'bookmark',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            $returnArray = ['type' => 'insert'];
        } else {
            DB::table('product_user')
                ->where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->delete();
            $returnArray = ['type' => 'delete'];
        }

        return response()->json($returnArray);
    }

    /**
     * 登録済みボタンの更新・削除処理
     * サブスク詳細における登録済みボタンをクリックした時
     */
    public function executeRegister(Request $request)
    {
        $user_id    = $request->userId;
        $product_id = $request->productId;

        $category = DB::table('product_user')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->pluck('category')
            ->toArray();

        if (empty($category)) {
            DB::table('product_user')
                ->insert([
                    'user_id'    => $user_id,
                    'product_id' => $product_id,
                    'category'   => 'register',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            $returnArray = ['type' => 'insert'];
        } elseif ($category[0] === 'bookmark') {
            DB::table('product_user')
                ->where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->update([
                    'category'   => 'register',
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            $returnArray = ['type' => 'update'];
        } else {
            DB::table('product_user')
                ->where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->delete();
            $returnArray = ['type' => 'delete'];
        }

        return response()->json($returnArray);
    }
}
