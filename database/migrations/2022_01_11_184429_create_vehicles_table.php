<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('type_id');
            $table->uuid('category_id');
            $table->uuid('department_id');
            $table->uuid('driver_id')->nullable()->default(NULL);
            $table->string('brand');
            $table->string('model');
            $table->string('plate_no');
            $table->date('acquisition_date');
            $table->boolean('is_assured')->default(true);
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
        Schema::dropIfExists('vehicles');
    }
}
