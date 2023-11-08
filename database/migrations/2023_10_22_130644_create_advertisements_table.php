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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reference');
            $table->longText('description');
            $table->foreignId('enterprise_id')->constrained('enterprises')
                ->onDelete('cascade');
            $table->foreignId('action_type')->constrained('call_to_actions')
                ->onDelete('cascade');
            $table->string('action_content');
            $table->string('picture');
            $table->double('total_amount');
            $table->integer('total_clics');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
