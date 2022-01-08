<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Payment;
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

        return view('search.simplesearch', compact('search_stores'));
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

        // 検索条件に合致する支払い方法を取得
        $payments = '';
        if (!empty($request->payments)) {
            $payments = array_column(Payment::whereIn('id', $request->payments)->get(['method'])->toArray(), 'method');
        }
        
        // 検索条件に合致するジャンルを取得
        $genres = '';
        if (!empty($request->genres)) {
            $genres = array_column(Genre::whereIn('id', $request->genres)->get(['name'])->toArray(), 'name');
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

        return view('search.detailsearch', compact('payments', 'genres', 'search_stores'));
    }
}
