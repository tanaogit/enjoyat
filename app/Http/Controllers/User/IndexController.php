<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * 認証ユーザー管理画面のホーム画面
     *
     * @return void
     */
    public function index()
    {
        $user_id = Auth::id();
        $user = User::with('genres:name')->findOrFail($user_id, ['id', 'username', 'email', 'name', 'icon', 'tel', 'zipcode', 'prefecture', 'city', 'street_address', 'gender', 'birthday']);

        return view('user.index', compact('user'));
    }

    /**
     * 認証ユーザー管理画面のお気に入りのサブスク表示画面
     *
     * @return void
     */
    public function bookmarkProducts()
    {
        $user = Auth::user();
        $bookmarkProducts = $user->bookmarkProducts()->orderBy('pivot_created_at', 'desc')->get();

        dd('bookmarkProducts', $bookmarkProducts);
    }

    /**
     * 認証ユーザー管理画面の登録済みのサブスク表示画面
     *
     * @return void
     */
    public function registerProducts()
    {
        $user = Auth::user();
        $registerProducts = $user->registerProducts()->orderBy('pivot_created_at', 'desc')->get();

        dd('registerProducts', $registerProducts);
    }

    /**
     * 認証ユーザー管理画面の投稿した口コミ表示画面
     *
     * @return void
     */
    public function posts()
    {
        $user = Auth::user();
        $posts = $user->posts()->latest()->get();

        dd('posts', $posts);
    }
}
