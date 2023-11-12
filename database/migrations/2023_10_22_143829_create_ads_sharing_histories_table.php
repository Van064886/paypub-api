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
        Schema::create('ads_sharing_histories', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->foreignId('ads_subscription_id')->constrained('ads_subscriptions')
                ->onDelete('cascade');
            $table->double('gained_amount');
            $table->foreignId('social_media_id')->constrained('social_medias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_sharing_histories');
    }
};
