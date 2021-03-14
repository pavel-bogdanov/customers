<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->default('');
            $table->string('password')->default('');
            $table->string('name')->default('');
            $table->foreignId('country_id')->constrained();
            $table->string('city')->default('');
            $table->string('state')->nullable()->default('');
            $table->string('zip')->nullable()->default('');
            $table->string('address')->default('');
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
