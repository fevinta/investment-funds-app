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
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->integer('start_year');
            $table->foreignId('company_id')->constrained();
            $table->timestamps();
        });

        Schema::create('company_fund', function (Blueprint $table) {
            $table->foreignId('company_id')->constrained();
            $table->foreignId('fund_id')->constrained();
            $table->timestamps();
            $table->primary(['fund_id', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_fund');
        Schema::dropIfExists('funds');
    }
};
