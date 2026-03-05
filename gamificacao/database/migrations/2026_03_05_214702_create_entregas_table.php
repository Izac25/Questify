<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id('id_entrega');
            $table->unsignedBigInteger('fk_id_atividade');
            $table->unsignedBigInteger('fk_id_aluno');
            $table->enum('status', ['pendente', 'entregue', 'confirmado'])->default('pendente');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};