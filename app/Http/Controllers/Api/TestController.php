<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        return $user;
    }
}
