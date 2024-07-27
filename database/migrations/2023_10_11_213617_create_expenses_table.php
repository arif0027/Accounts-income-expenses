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
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('expense_id');
            $table->string('expense_title',200)->nullable();
            $table->integer('expcate_id')->nullable();
            $table->string('expense_amount',20)->nullable();
            $table->string('expense_date')->nullable();
            $table->integer('expense_creator')->nullable();
            $table->integer('expense_editor')->nullable();
            $table->string('expense_slug',30)->nullable();
            $table->integer('expense_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
