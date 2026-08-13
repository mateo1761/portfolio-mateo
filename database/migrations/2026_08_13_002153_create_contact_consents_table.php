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
        Schema::create('contact_consents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('email_hash', 64)->index();
            $table->timestamp('consented_at')->index();
            $table->string('policy_version', 20);
            $table->string('locale', 2);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_consents');
    }
};
