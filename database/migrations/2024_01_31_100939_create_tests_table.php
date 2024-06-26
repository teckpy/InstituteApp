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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 55);
            $table->string('date', 55);
            $table->string('test_exam_id', 15)->default(null);
            $table->string('time')->default('0');
            $table->integer('attempt');
            $table->integer('marks')->default('0');
            $table->integer('passing_marks')->default('0');
            $table->integer('plan', 11)->default(null)->comment('0->free,1->paid');
            $table->json('prices')->default(null);
            $table->integer('subject_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
