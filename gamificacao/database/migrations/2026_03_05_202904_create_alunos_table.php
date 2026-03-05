<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id('id_aluno');
            $table->unsignedBigInteger('fk_id_turma')->nullable();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('turno')->nullable();
            $table->integer('pontos')->default(0);
            $table->integer('pontos_comportamento')->default(0);
            $table->integer('frequencia')->default(0);
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};