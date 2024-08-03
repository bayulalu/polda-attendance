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
        Schema::create('attemdances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 100);
            $table->string('file_assignment')->nullable();
            $table->string('foto')->nullable();
            $table->string('check_in', 10)->nullable();
            $table->string('check_out', 10)->nullable();
            $table->tinyInteger('status')->default(1);

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('settings_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attemdances');
    }
};
