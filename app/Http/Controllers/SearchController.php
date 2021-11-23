<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function simplesearch(Request $request)
    {
        dd('simplesearch', $request); // 開発時に消す
    }

    public function detailsearch(Request $request)
    {
        dd('detailsearch', $request); // 開発時に消す
    }
}
