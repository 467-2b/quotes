<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('associate_id');
            $table->enum('status', ["unfinalized", "finalized", "sanctioned", "processed"])->default('unfinalized');
            $table->string('customer_name');
            $table->decimal('discount_amount', 9, 2)->default(0.0);
            $table->decimal('discount_percent', 2, 0)->default(0.0);
            $table->decimal('total_amount', 9, 2)->default(0.0);
            $table->decimal('commission_percent', 2, 0)->default(0.0);
            $table->timestamps();
            $table->foreign('associate_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
