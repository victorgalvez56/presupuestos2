<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price_dollar');
            $table->double('quantity');
            $table->string('description');
            $table->double('unit_price');
            $table->double('total_soles');
            $table->double('total_dollars');
            $table->integer('month_id')->unsigned();
            $table->foreign('month_id')->references('id')->on('months')->onDelete('cascade');
            $table->integer('batch_id')->unsigned();
            $table->foreign('batch_id')->references('id')->on('batchs')->onDelete('cascade');
            $table->integer('budget_id')->unsigned();
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
            $table->string('status')->default('available');
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
        Schema::dropIfExists('details_budgets');
    }
}
