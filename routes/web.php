<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetsController;
use Laravel\Socialite\Facades\Socialite;

Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/', 'web\HomeController@home');

Route::get('/', 'auth\ConfirmPasswordController@home')->name('ConfirmarSenha');

Route::get('/', 'auth\ForgotPasswordController@home')->name('EsqueceuSenha');

Route::get('/', [LoginController::class, 'loginController'])->name('Login');

Route::get('/', 'auth\RegisterController@home')->name('Registrar');

Route::get('/', 'auth\ResetPasswordController@home')->name('Resetar');

Route::get('/', 'auth\VerificationController@home')->name('Verificar');

Route::get('/', 'index\BudgetsController@login')->name('budgets.login');

Route::get('profile', function () {
    // Only authenticated users may enter...
})->middleware('auth');

Route::get('/confirm-password', function () {
    return view('auth.confirm-password');
})->middleware('auth')->name('password.confirm');

/* Rota de create direcionando para o método create*/
Route::get('/create', [BudgetsController::class, 'create'])->name('budgets.create');

/* Rota de vizualização direcionando para o método show*/
Route::get('budgets/show/{id}', [BudgetsController::class, 'show'])->name('budgets.show');

/* Rota de pesquisa direcionando para o método show*/
Route::post('/search', [BudgetsController::class, 'search'])->name('budgets.search');

/* Rota de index direcionando para o método index*/
Route::get('/', [BudgetsController::class, 'index'])->name('budgets');
Route::get('/budgets', [BudgetsController::class, 'index'])->name('budgets');

/* Rota de inserção de cadastro no DB direcionando para o método store*/
Route::post('/budgets', [BudgetsController::class, 'store'])->name('budgets.store');

/* Rota de edit direcionando para o método edit*/
Route::get('/{id}', [BudgetsController::class, 'edit'])->name('budgets.edit');

/* Rota de atualização direcionando para o método update*/
Route::post('/bugets/update/{id}', [BudgetsController::class, 'update'])->name('budgets.update');

/* Rota de exclusão direcionando para o método delete*/
Route::delete('/destroy/{id}', [BudgetsController::class, 'destroy'])->name('budgets.destroy');

Route::post('/budgets', [BudgetsController::class, 'show'])->name('budgets.show');

Route::get('/auth/redirect', function () {
    return Socialite::driver('facebook')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('facebook')->user();

    // OAuth 2.0 providers...
    $token = $user->token;
    $refreshToken = $user->refreshToken;
    $expiresIn = $user->expiresIn;

    // OAuth 1.0 providers...
    $token = $user->token;
    $tokenSecret = $user->tokenSecret;

    // All providers...
    $user->getId();
    $user->getNickname();
    $user->getName();
    $user->getEmail();
    $user->getAvatar();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('facebook')->user();

    // $user->token
});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
