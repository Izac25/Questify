<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TurmaController;

Route::get('/', function () {
    return redirect('/login');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Cadastro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout']);

// Dashboard
Route::get('/dashboard', function () {
    return view('dashbord');
})->middleware('auth:web,instrutor');

// Turmas (só instrutor)
Route::middleware('auth:instrutor')->group(function () {
    Route::get('/turmas', [TurmaController::class, 'index']);
    Route::get('/turmas/criar', [TurmaController::class, 'create']);
    Route::post('/turmas', [TurmaController::class, 'store']);
    Route::get('/turmas/{id}/editar', [TurmaController::class, 'edit']);
    Route::put('/turmas/{id}', [TurmaController::class, 'update']);
    Route::delete('/turmas/{id}', [TurmaController::class, 'destroy']);
});