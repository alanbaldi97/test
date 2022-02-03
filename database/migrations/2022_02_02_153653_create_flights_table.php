<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->enum('type',['PASSENGER', 'FREIGHT']);
            $table->foreignId('departure_id')->constrained('airports');
            $table->foreignId('destination_id')->constrained('airports');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->foreignId('airline_id')->constrained();
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
        Schema::dropIfExists('flights');
    }
}
