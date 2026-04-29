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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('role');
            $table->String('blood_group');
            $table->String('status');
            $table->String('role_no');
            $table->string('class');
            $table->password('class');
            $table->String('section');
            $table->date('admission_date');
            $table->String('guardian_name');
            $table->string('guardian_phone');
            $table->String('guardian_email');
            $table->text('address');
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
