<?php

namespace App\Services;

use InterventionImage;

class ImageService
{
    /**
     * 店舗の写真のstorageへの登録処理
     */
    public static function storeimage_upload($image)
    {
        // ランダムに名前を作成
        $image_name = uniqid(rand() . '_');
        // 拡張子の取得
        $image_extension = $image->extension();
        // 写真を整形して保存
        $storeimage = InterventionImage::make($image)->resize(600, 600)->orientate()->save(storage_path('app/public/storeimages/'. $image_name . '.' . $image_extension));

        return $storeimage;
    }
}
