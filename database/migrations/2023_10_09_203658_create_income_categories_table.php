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
        Schema::create('income_categories', function (Blueprint $table) {
            $table->bigIncrements('incate_id');
            $table->string('incate_name',200)->unique();
            $table->string('incate_remarks',200)->nullable();
            $table->integer('incate_creator')->nullable();
            $table->integer('incate_editor')->nullable();
            $table->string('incate_slug',50)->nullable();
            $table->integer('incate_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_categories');
    }
};
