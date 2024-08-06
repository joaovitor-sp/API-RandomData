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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('email');
            $table->string('avatar');
            $table->string('gender');
            $table->string('phone_number');
            $table->string('social_insurance_number');
            $table->string('date_of_birth');
            $table->string('employment_title');
            $table->string('employment_key_skill');
            $table->string('address_city');
            $table->string('address_street_name');
            $table->string('address_street_address');
            $table->string('address_zip_code');
            $table->string('address_state');
            $table->string('address_country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
