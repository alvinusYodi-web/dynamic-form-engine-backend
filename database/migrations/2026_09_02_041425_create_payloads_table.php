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
        Schema::create('payloads', function (Blueprint $table) {
            $table->string("id", 50)->primary();
            $table->string("section_id", 50);
            $table->string("label", 255);
            $table->string("type", 50);
            $table->string("sub_type", 50)->nullable();
            $table->text("description")->nullable();
            $table->timestamps();

            $table->foreign("section_id")
                  ->references("id")
                  ->on("sections");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payloads');
    }
};
