<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Payment;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // トップページ
    public function index()
    {
        $genres   = Genre::get(['id', 'name']);
        $payments = Payment::get(['id', 'method']);

        return view('index', compact('genres', 'payments'));
    }
}
