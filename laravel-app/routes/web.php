<?php

use App\Http\Controllers\VisitorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Landing page (static) */
Route::get('/', function (Request $request) {
    $lang   = $request->query('lang') === 'en' ? 'en' : 'id';
    $t      = config("content.content.{$lang}");
    $images = config('content.images');

    return view('landing', [
        'lang'   => $lang,
        't'      => $t,
        'images' => $images,
    ]);
})->name('home');

/* Visitor flow (dynamic) */
Route::get('/visitor-form',  [VisitorController::class, 'form' ])->name('visitor.form');
Route::post('/visitor-form', [VisitorController::class, 'store'])->name('visitor.store');

Route::get   ('/visitor-data',        [VisitorController::class, 'index'      ])->name('visitor.index');
Route::get   ('/visitor-data/export', [VisitorController::class, 'export'     ])->name('visitor.export');
Route::delete('/visitor-data',        [VisitorController::class, 'destroyAll'])->name('visitor.destroy_all');
