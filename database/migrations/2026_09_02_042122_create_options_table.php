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
        Schema::create('options', function (Blueprint $table) {
            $table->string("id", 50)->primary();
            $table->string("payload_id", 50);
            $table->string("label", 255);
            $table->string("value", 255);
            $table->timestamps();

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
        Schema::dropIfExists('options');
    }
};
