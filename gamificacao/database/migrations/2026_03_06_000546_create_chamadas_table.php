<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chamadas', function (Blueprint $table) {
            $table->id('id_chamada');
            $table->unsignedBigInteger('fk_id_aluno');
            $table->unsignedBigInteger('fk_id_instrutor');
            $table->unsignedBigInteger('fk_id_turma');
            $table->date('data');
            $table->boolean('presente')->default(false);
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chamadas');
    }
};