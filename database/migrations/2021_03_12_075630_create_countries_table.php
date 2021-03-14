<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('iso_2')->default('')->unique();
            $table->string('iso_3')->nullable()->default('');
            $table->string('name')->default('');
            $table->string('capital')->nullable()->default(null);
            $table->float('area', 9, 2)->default(null);
            $table->string('flag')->default(null);
            $table->string('currency_code')->default(null);
            $table->string('currency_symbol');
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
        Schema::dropIfExists('countries');
    }
}
