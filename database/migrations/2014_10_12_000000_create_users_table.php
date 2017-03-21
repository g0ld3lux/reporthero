<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',32);
            $table->string('last_name',32);
            $table->string('email',80)->unique();
            $table->string('password',60);
            $table->boolean('verified')->default(0); // Email Must be Verified
            $table->boolean('activated')->default(0); // Account Must Be Activated
            $table->boolean('banned')->default(0); // Account is Banned
            $table->boolean('on_trial')->default(1); // On Sign Up Trial is ON
            $table->boolean('subscribed')->default(0); // If User Subscribe
            $table->unsignedTinyInteger('resent')->default(0); // For Sending Password Reset Email
            $table->json('settings')->nullable();
            $table->json('klaviyo_api')->nullable();
            $table->string('store_type')->nullable();
            $table->boolean('public')->default(false);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
