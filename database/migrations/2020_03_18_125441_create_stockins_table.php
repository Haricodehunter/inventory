<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supid');
            $table->string('lotname');
            $table->string('note');
            $table->string('image');
            $table->string('approvaldate');
            $table->string('approved');
            $table->string('approvedby');
            $table->string('categoryid');
            $table->string('subcategoryid');
            $table->string('buildingname');
            $table->string('uniqtag');
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
        Schema::dropIfExists('stockins');
    }
}
