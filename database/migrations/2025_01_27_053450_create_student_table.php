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
        Schema::create('student', function (Blueprint $table) {
            $table->id('student_id'); 
            $table->string('name',60); //60 is the character limit
            $table->string('password');
            $table->integer('age');
            $table->enum('gender', ["M","F","O"])->nullable();
            $table->enum('course',["Commerce","Science"]);
            $table->boolean('status')->default(0); //passed or fail
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
