<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instrutors', function (Blueprint $table) {
            $table->id('id_instrutor');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instrutors');
    }
};