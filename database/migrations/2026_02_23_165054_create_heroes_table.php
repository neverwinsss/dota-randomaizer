<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('heroes', function (Blueprint $table) {
        $table->id(); // Тот самый (int ai)
        $table->string('name'); // Имя героя
        $table->text('info')->nullable(); // Описание (nullable, чтобы не было ошибки, если пусто)
        $table->string('photo'); // Путь к картинке
        $table->timestamps(); // Создает столбцы created_at и updated_at
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
