<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('regencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('regency_id')->constrained('regencies')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('regencies');
        Schema::dropIfExists('provinces');
    }
};
