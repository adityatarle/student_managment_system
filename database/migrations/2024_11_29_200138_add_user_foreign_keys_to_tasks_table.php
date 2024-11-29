<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tasks', function (Blueprint $table) {
        // Ensure student_id and teacher_id are of the correct type (unsignedBigInteger)
        $table->unsignedBigInteger('student_id')->nullable()->change();  // Make sure it's nullable, or change to not nullable if needed
        $table->unsignedBigInteger('teacher_id')->nullable()->change();  // Same for teacher_id

        // Add foreign key constraints with onDelete('cascade')
        $table->foreign('student_id')->references('user_id')->on('students')->onDelete('cascade');
        $table->foreign('teacher_id')->references('user_id')->on('teachers')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('tasks', function (Blueprint $table) {
        // Drop the foreign key constraints
        $table->dropForeign(['student_id']);
        $table->dropForeign(['teacher_id']);

        // If necessary, revert column changes (e.g., make them nullable again or not)
    });
}

};
