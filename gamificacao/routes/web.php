<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\ComportamentoController;
use App\Http\Controllers\AdminController;

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
    if (Auth::guard('web')->check()) {
        $aluno = Auth::guard('web')->user();
        $turno = $aluno->turno;
        $id_turma = $aluno->fk_id_turma;

        $rankTurno = \App\Models\Aluno::where('turno', $turno)
            ->orderBy('pontos', 'desc')
            ->take(10)
            ->get();

        $rankSala = \App\Models\Aluno::where('fk_id_turma', $id_turma)
            ->orderBy('pontos', 'desc')
            ->get();

        $rankComportamento = \App\Models\Aluno::where('fk_id_turma', $id_turma)
            ->orderBy('pontos_comportamento', 'desc')
            ->get();

        $atividades = \App\Models\Atividade::where('turno', $turno)
            ->orderBy('data_limite', 'asc')
            ->get();

        $minhasEntregas = \App\Models\Entrega::where('fk_id_aluno', $aluno->id_aluno)
            ->pluck('fk_id_atividade')
            ->toArray();

        return view('dashbord', compact('rankTurno', 'rankSala', 'rankComportamento', 'atividades', 'minhasEntregas'));
    }

    return view('dashbord', [
        'rankTurno' => collect(),
        'rankSala' => collect(),
        'rankComportamento' => collect(),
        'atividades' => collect(),
        'minhasEntregas' => [],
    ]);
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

// Alunos (só instrutor)
Route::middleware('auth:instrutor')->group(function () {
    Route::get('/alunos', [AlunoController::class, 'index']);
    Route::get('/alunos/{id}/editar', [AlunoController::class, 'edit']);
    Route::put('/alunos/{id}', [AlunoController::class, 'update']);
    Route::delete('/alunos/{id}', [AlunoController::class, 'destroy']);
});

// Atividades (só instrutor)
Route::middleware('auth:instrutor')->group(function () {
    Route::get('/atividades', [AtividadeController::class, 'index']);
    Route::get('/atividades/criar', [AtividadeController::class, 'create']);
    Route::post('/atividades', [AtividadeController::class, 'store']);
    Route::delete('/atividades/{id}', [AtividadeController::class, 'destroy']);
    Route::get('/atividades/{id}/entregas', [AtividadeController::class, 'entregas']);
    Route::post('/entregas/{id}/confirmar', [AtividadeController::class, 'confirmar']);
    Route::post('/entregas/{id}/presenca', [AtividadeController::class, 'marcarPresenca']);
    Route::post('/comportamento', [ComportamentoController::class, 'store']);
});

// Entregar atividade (só aluno)
Route::middleware('auth:web')->group(function () {
    Route::post('/atividades/{id}/entregar', [AtividadeController::class, 'entregar']);
});

// Perfil (só aluno)
Route::middleware('auth:web')->group(function () {
    Route::get('/perfil/editar', [PerfilController::class, 'edit']);
    Route::put('/perfil', [PerfilController::class, 'update']);
});

// Perfil (só instrutor)
Route::middleware('auth:instrutor')->group(function () {
    Route::get('/perfil/instrutor/editar', [PerfilController::class, 'editInstrutor']);
    Route::put('/perfil/instrutor', [PerfilController::class, 'updateInstrutor']);
});

// Admin
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/instrutores', [AdminController::class, 'instrutores']);
    Route::post('/admin/instrutores', [AdminController::class, 'criarInstrutor']);
    Route::delete('/admin/instrutores/{id}', [AdminController::class, 'deletarInstrutor']);
    Route::get('/admin/alunos', [AdminController::class, 'alunos']);
    Route::put('/admin/alunos/{id}/mover', [AdminController::class, 'moverAluno']);
    Route::delete('/admin/alunos/{id}', [AdminController::class, 'deletarAluno']);
});