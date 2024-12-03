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
        Schema::create('formulirs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status')->nullable();
            $table->string('response')->nullable();
            $table->string('domain')->nullable();
            $table->string('url')->nullable();
            $table->string('loc-a')->nullable();
            $table->string('loc-b')->nullable();
            $table->string('dns-record')->nullable();
            $table->string('dns-formula')->nullable();
            $table->string('vapt')->nullable();
            $table->string('desc')->nullable();
            $table->string('credential')->nullable();
            $table->string('pentest')->nullable();
            $table->date('date')->nullable();
            $table->string('critical')->nullable();
            $table->string('high')->nullable();
            $table->string('medium')->nullable();
            $table->string('low')->nullable();
            $table->string('info')->nullable();
            $table->string('method')->nullable();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulirs');
    }
};
