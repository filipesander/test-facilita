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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('library_user_id');
            $table->unsignedBigInteger('book_id');
            $table->date('due_date');
            $table->enum('status', ['emprestado', 'devolvido', 'atrasado'])->default('emprestado');
            $table->timestamps();

            $table->foreign('library_user_id')->references('id')->on('library_users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
