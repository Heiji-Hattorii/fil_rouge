<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
Route::get('/', function () {
    return view('welcome');
});
Route::post('/content',[ContentController::class,'store']);
Route::post('/content/update',[ContentController::class,'update'])->name('content.update');
Route::get('/content',[ContentController::class,'index'])->name('content.index');
Route::post('/content/delete',[ContentController::class,'destroy'])->name('content.delete');
Route::get('/content/{id}/details', [ContentController::class, 'show'])->name('content.details');
