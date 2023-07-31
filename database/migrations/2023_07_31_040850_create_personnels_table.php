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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();
            $table->uuid('office_record_id');
            $table->foreign('office_record_id')
                ->references('id')
                ->on('records')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('access')->nullable();
            $table->string('role')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
