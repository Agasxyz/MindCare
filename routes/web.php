<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\User\CommunityController;
use App\Http\Controllers\User\MeditationController;
use App\Http\Controllers\User\SelfTestController;
use App\Http\Controllers\User\GoalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Temporary route for storage linking
Route::get('/link-storage', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    // Check if link already exists
    if (file_exists($link)) {
        return 'Storage link already exists.';
    }

    try {
        symlink($target, $link);
        return 'Storage link created successfully.';
    } catch (\Exception $e) {
        return 'Failed to create link: ' . $e->getMessage();
    }
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Register route placeholder if needed
Route::get('/register', function () {
    return view('auth.auth');
})->name('register');


// Public Article Routes
Route::get('/article', [ArticleController::class, 'index'])->name('article');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');

// User Routes
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/mood', [UserDashboardController::class, 'storeMood'])->name('mood.store');

    Route::get('/article', [ArticleController::class, 'index'])->name('article');
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('/community/post', [CommunityController::class, 'store'])->name('community.store');
    Route::post('/community/{id}/like', [CommunityController::class, 'like'])->name('community.like');
    Route::post('/community/{id}/comment', [CommunityController::class, 'storeComment'])->name('community.comment');

    Route::get('/meditation', [MeditationController::class, 'index'])->name('meditation');
    Route::get('/meditation/{id}/play', [MeditationController::class, 'play'])->name('meditation.play');

    Route::get('/selftest', [SelfTestController::class, 'index'])->name('selftest');
    Route::post('/selftest/result', [SelfTestController::class, 'storeResult'])->name('selftest.store');

    Route::get('/goals', [GoalController::class, 'index'])->name('goals');
    Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
    Route::put('/goals/{id}', [GoalController::class, 'update'])->name('goals.update');
    Route::delete('/goals/{id}', [GoalController::class, 'destroy'])->name('goals.destroy');
});

// Admin Routes
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Article
    Route::get('/article', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('article');
    Route::get('/article/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('article.create'); // Add create route
    Route::post('/article', [App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('article.store');
    Route::get('/article/{id}/edit', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/article/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('article.update');
    Route::delete('/article/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'destroy'])->name('article.destroy');

    // Meditation
    Route::get('/meditation', [App\Http\Controllers\Admin\MeditationController::class, 'index'])->name('meditation');
    Route::get('/meditation/create', [App\Http\Controllers\Admin\MeditationController::class, 'create'])->name('meditation.create');
    Route::post('/meditation', [App\Http\Controllers\Admin\MeditationController::class, 'store'])->name('meditation.store');
    Route::get('/meditation/{id}/edit', [App\Http\Controllers\Admin\MeditationController::class, 'edit'])->name('meditation.edit');
    Route::put('/meditation/{id}', [App\Http\Controllers\Admin\MeditationController::class, 'update'])->name('meditation.update');
    Route::delete('/meditation/{id}', [App\Http\Controllers\Admin\MeditationController::class, 'destroy'])->name('meditation.destroy');

    // Question
    Route::get('/question', [AdminQuestionController::class, 'index'])->name('question');
    Route::get('/question/create', [AdminQuestionController::class, 'create'])->name('question.create');
    Route::post('/question', [AdminQuestionController::class, 'store'])->name('question.store');
    Route::get('/question/{id}/edit', [AdminQuestionController::class, 'edit'])->name('question.edit');
    Route::put('/question/{id}', [AdminQuestionController::class, 'update'])->name('question.update');
    Route::delete('/question/{id}', [AdminQuestionController::class, 'destroy'])->name('question.destroy');

    // Comment (Forum)
    Route::get('/comment', [AdminForumController::class, 'index'])->name('comment');
    Route::delete('/comment/{id}', [AdminForumController::class, 'destroy'])->name('comment.destroy');
});

// Partial Public Routes (if any allowed without login, otherwise user middleware handles protection)