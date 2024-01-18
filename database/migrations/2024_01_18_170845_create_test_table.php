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
        Schema::create('test', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('question');
            $table->string('result');
            $table->timestamps();
            $table->foreign('class_id')->reference('id')->on('classes')->onDelete('cascade');
            $table->foreign('student_id')->reference('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test');
    }
};
