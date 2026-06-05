<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $lang = $request->query('lang') === 'en' ? 'en' : 'id';
    $t      = config("content.content.{$lang}");
    $images = config('content.images');

    return view('landing', [
        'lang'   => $lang,
        't'      => $t,
        'images' => $images,
    ]);
})->name('home');
