<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\NotationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::post('/content', [ContentController::class, 'store']);
Route::post('/content/update', [ContentController::class, 'update'])->name('content.update');
Route::get('/content', [BibliothequeController::class, 'myindex'])->name('content.index');
Route::post('/content/delete', [ContentController::class, 'destroy'])->name('content.delete');
Route::get('/content/{id}/details', [ContentController::class, 'show'])->name('content.details');


Route::get('/anime/create/{content_id}', [AnimeController::class, 'create'])->name('anime.create');
Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');
Route::get('/anime/{id}/details', [AnimeController::class, 'show'])->name('anime.details');

Route::get('/manga/create/{content_id}', [MangaController::class, 'create'])->name('manga.create');
Route::post('/manga/', [MangaController::class, 'store'])->name('manga.store');
Route::get('/manga/{id}/details', [MangaController::class, 'show'])->name('manga.details');

Route::get('/manga/{manga_id}/chapitres', [ChapitreController::class, 'index'])->name('manga.chapitres.index');
Route::get('/manga/{manga_id}/chapitres/create', [ChapitreController::class, 'create'])->name('manga.chapitres.create');
Route::post('/chapitres', [ChapitreController::class, 'store'])->name('manga.chapitres.store');

Route::get('/chapitres/{id}', [ChapitreController::class, 'show'])->name('manga.chapitres.show');
Route::get('/chapitres/{id}/edit', [ChapitreController::class, 'edit'])->name('manga.chapitres.edit');
Route::put('/chapitres/{id}', [ChapitreController::class, 'update'])->name('manga.chapitres.update');
Route::delete('/chapitres/{id}', [ChapitreController::class, 'destroy'])->name('manga.chapitres.destroy');


Route::get('/chapitres/{chapitre_id}/pages/create', [PageController::class, 'create'])->name('manga.pages.create');
Route::post('/chapitres/{chapitre_id}/pages', [PageController::class, 'store'])->name('manga.pages.store');
Route::get('/chapitres/{chapitre_id}/pages', [PageController::class, 'index'])->name('manga.chapitres.pages.index');
Route::get('/chapitres/{chapitre_id}/pages', [PageController::class, 'showall'])->name('manga.chapitres.pages.show');
Route::post('/pages/{id}', [PageController::class, 'update'])->name('manga.pages.update');
Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('manga.pages.destroy');




Route::prefix('anime/{anime_id}')->group(function () {
    Route::get('episodes', [EpisodeController::class, 'index'])->name('anime.episodes.index');
    Route::post('episodes', [EpisodeController::class, 'store'])->name('anime.episodes.store');
    Route::put('episodes/{id}', [EpisodeController::class, 'update'])->name('anime.episodes.update');
    Route::get('episodes/{id}', [EpisodeController::class, 'show'])->name('anime.episodes.show');
    Route::delete('episodes/{id}', [EpisodeController::class, 'destroy'])->name('anime.episodes.destroy');
});





Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('signup', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('bibliotheques', BibliothequeController::class);
});
Route::post('/bibliotheque/ajouter/{content_id}', [BibliothequeController::class, 'ajouter'])->name('bibliotheque.ajouter');
Route::delete('/bibliotheque/retirer/{content_id}', [BibliothequeController::class, 'retirer'])->name('bibliotheque.retirer');


Route::post('/commentaire/store', [CommentaireController::class, 'store'])->name('commentaire.store');


Route::post('notation/store/{contentId}', [NotationController::class, 'store'])->name('notation.store');
Route::get('notation/average/{contentId}', [NotationController::class, 'getAverageRating'])->name('notation.average');

Route::middleware(['auth'])->group(function () {
    Route::resource('rooms', RoomController::class);

    Route::post('/rooms/{room}/join', [RoomController::class, 'join'])->name('rooms.join');

    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::put('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::prefix('content/{content}')->group(function () {
        Route::get('quiz', [QuizController::class, 'index'])->name('content.quiz.index');
        Route::post('quiz', [QuizController::class, 'store'])->name('content.quiz.store');

    });


    Route::put('/quizzes/{quiz}', [QuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
    Route::resource('quiz.question', QuestionController::class);
    Route::get('/quiz/{quiz}/play', [QuizController::class, 'play'])->name('quiz.play');



    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');


});