<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Ruta Dashbpard modificada
Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->user();

    // $user->token
    $user = User::updateOrCreate(
        [
            'google_id' => $user_google->id,
        ],
        [
            'name' => $user_google->name,
            'email' => $user_google->email,
        ]
    );

    Auth::login($user);
    return redirect('/dashboard');
});







require __DIR__ . '/settings.php';
