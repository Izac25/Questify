<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('atividades', function (Blueprint $table) {
            // Adiciona a coluna fk_id_turma
            $table->unsignedBigInteger('fk_id_turma')->nullable()->after('fk_id_instrutor');
            
            // Define a chave estrangeira
            $table->foreign('fk_id_turma')
                ->references('id_turma')
                ->on('turmas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('atividades', function (Blueprint $table) {
            $table->dropForeign(['fk_id_turma']);
            $table->dropColumn('fk_id_turma');
        });
    }
};