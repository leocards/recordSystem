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
        Schema::create('office_records', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('record_id');
            $table->foreign('record_id')
                ->references('id')
                ->on('records')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('office_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_records');
    }
};
