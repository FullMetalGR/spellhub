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
        Schema::create('spells', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('school');
            $table->json('components')->nullable();
            $table->enum('rarity', ['Common', 'Uncommon', 'Rare', 'Epic', 'Legendary'])->default('Common');
            $table->string('level');
            $table->foreignId('created_by')->constrained('users');
            $table->boolean('is_public')->default(true);
            $table->timestamps();

            $table->unique(['name', 'created_by'], 'unique_spell_name_per_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spells');
    }
};
