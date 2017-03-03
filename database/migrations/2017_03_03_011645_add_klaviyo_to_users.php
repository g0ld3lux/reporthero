<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKlaviyoToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('name');
            $table->dropColumn('role');
            $table->text('klaviyo_api')->nullable();
            $table->string('store_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['store_type', 'klaviyo_api', 'last_name']);
            $table->string('role')->default('user');
            $table->renameColumn('first_name', 'name');
        });
    }
}
