<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * お問い合わせフォーム
     */
    public function contact()
    {
        return view('support.contact');
    }
}
