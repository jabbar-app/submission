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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('team_members')->nullable();
            $table->text('problems')->nullable();
            $table->text('solutions')->nullable();
            $table->text('target_beneficiaries')->nullable();
            $table->text('unique_value')->nullable();
            $table->text('key_features')->nullable();
            $table->text('funding_needs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
