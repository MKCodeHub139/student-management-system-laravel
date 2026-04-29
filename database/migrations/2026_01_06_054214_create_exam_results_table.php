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
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->json('questions')->nullable();
            $table->String('grade')->nullable();
            $table->String('totalMarks')->nullable();
            $table->String('marksOutOf')->nullable();
            $table->json('marks')->nullable();
            $table->enum('result',['fail','pass'])->nullable();
            $table->integer('completed_question')->default(1);
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
