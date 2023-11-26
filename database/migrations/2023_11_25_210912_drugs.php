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
        //
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->string('drug_name');
            $table->string('drug_category');
            $table->string('drug_image');
            $table->integer('drug_price');
            $table->longText('drug_description');
            $table->integer('unit_quantity');
            $table->string('unit_description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
