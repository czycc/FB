<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Img;

class ImgController extends Controller
{
    public function show()
    {
        $imgs = Img::all();
        return view('img', compact('imgs'));
    }
}
