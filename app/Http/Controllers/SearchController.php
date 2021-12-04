<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class SearchController extends Controller
{
    public function simplesearch(Request $request)
    {
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 12;
        } else {
            $display_count = 18;
        }

        $search_stores = Store::AccessFilter($request->pref, $request->line, $request->station)->Paginate($display_count);

        dd('simplesearch', $request, 'stores', $search_stores); // 開発時に消す
    }

    public function detailsearch(Request $request)
    {
        if (is_mobile($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 6;
        } elseif (is_tablet($_SERVER['HTTP_USER_AGENT'])) {
            $display_count = 12;
        } else {
            $display_count = 18;
        }

        $businessdays = $request->businessdays;
        $search_stores = Store::AccessFilter($request->pref, $request->line, $request->station)
                            ->FreeWordFilter($request->freeword)
                            ->where(function ($query) use ($businessdays) {
                                $query->BusinessDaysFilter($businessdays);
                            })
                            ->EvaluationFilter($request->evaluation)
                            ->PaymentsFilter($request->payments)
                            ->CouponFilter($request->coupon)
                            ->GenresFilter($request->genres)
                            ->Paginate($display_count);
        
        dd('detailsearch', $request, 'stores', $search_stores); // 開発時に消す
    }
}
