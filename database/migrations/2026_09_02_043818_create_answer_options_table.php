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
        Schema::create('answer_options', function (Blueprint $table) {
            $table->unsignedBigInteger("answer_id");
            $table->string("option_id", 50);
            $table->primary(["answer_id", "option_id"]);
            $table->foreign("answer_id")
                ->references("id")
                ->on("answers");

            $table->foreign("option_id")
                ->references("id")
                ->on("options");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_options');
    }
};
