<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id('id_atividade');
            $table->unsignedBigInteger('fk_id_instrutor');
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->integer('pontos')->default(0);
            $table->string('turno');
            $table->date('data_limite')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atividades');
    }
};