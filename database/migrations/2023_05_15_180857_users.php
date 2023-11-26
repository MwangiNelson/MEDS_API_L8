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
        //
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('user_name');
            $table->foreign('user_role')->references('id')->on('tbl_roles')->onDelete('cascade');
            $table->string('user_email')->unique();
            $table->string('user_password');
            $table->rememberToken();
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
