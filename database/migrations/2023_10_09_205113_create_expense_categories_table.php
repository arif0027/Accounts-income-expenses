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
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->bigIncrements('expcate_id');
            $table->string('expcate_name',200)->unique();
            $table->string('expcate_remarks',200)->nullable();
            $table->integer('expcate_creator')->nullable();
            $table->integer('expcate_editor')->nullable();
            $table->string('expcate_slug',50)->nullable();
            $table->integer('expcate_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_categories');
    }
};
