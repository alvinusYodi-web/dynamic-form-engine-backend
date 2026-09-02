<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payloads', function (Blueprint $table) {
            $table->index('section_id');
        });

        Schema::table('options', function (Blueprint $table) {
            $table->index('payload_id');
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->index('risk_event_id');
            $table->index('payload_id');
        });

        Schema::table('answer_options', function (Blueprint $table) {
            $table->index('option_id');
        });
    }

    public function down(): void
    {
        Schema::table('payloads', function (Blueprint $table) {
            $table->dropIndex(['section_id']);
        });

        Schema::table('options', function (Blueprint $table) {
            $table->dropIndex(['payload_id']);
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->dropIndex(['risk_event_id']);
            $table->dropIndex(['payload_id']);
        });

        Schema::table('answer_options', function (Blueprint $table) {
            $table->dropIndex(['option_id']);
        });
    }
};