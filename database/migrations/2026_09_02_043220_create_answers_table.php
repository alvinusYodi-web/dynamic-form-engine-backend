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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("risk_event_id");
            $table->string("payload_id", 50);
            $table->text("value")->nullable();
            $table->timestamps();

            $table->foreign("risk_event_id") 
                  ->references("id")
                  ->on("risk_events");
            $table->foreign("payload_id") 
                  ->references("id")
                  ->on("payloads");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
