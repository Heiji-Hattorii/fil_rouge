<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\MangaController;
Route::get('/', function () {
    return view('welcome');
});
Route::post('/content',[ContentController::class,'store']);
Route::post('/content/update',[ContentController::class,'update'])->name('content.update');
Route::get('/content',[ContentController::class,'index'])->name('content.index');
Route::post('/content/delete',[ContentController::class,'destroy'])->name('content.delete');
Route::get('/content/{id}/details', [ContentController::class, 'show'])->name('content.details');


Route::get('/anime/create/{content_id}', [AnimeController::class, 'create'])->name('anime.create');
Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');
Route::get('/anime/{id}/details', [AnimeController::class, 'show'])->name('anime.details');

Route::get('/manga/create/{content_id}', [MangaController::class, 'create'])->name('manga.create');
Route::post('/manga/', [MangaController::class, 'store'])->name('manga.store');
Route::get('/manga/{id}/details', [MangaController::class, 'show'])->name('manga.details');
