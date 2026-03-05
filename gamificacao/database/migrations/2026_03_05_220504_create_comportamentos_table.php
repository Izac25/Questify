<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comportamentos', function (Blueprint $table) {
            $table->id('id_comportamento');
            $table->unsignedBigInteger('fk_id_aluno');
            $table->unsignedBigInteger('fk_id_instrutor');
            $table->string('motivo');
            $table->string('motivo_livre')->nullable();
            $table->integer('pontos'); // positivo ou negativo
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comportamentos');
    }
};