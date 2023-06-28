<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE = "debts";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('debtor_id')->unsigned()->references('id')->on('debtors');
            $table->double('debt_amount')->unsigned();
            $table->double('paid_amount')->unsigned()->nullable();
            $table->date('debt_due_date');
            $table->dateTime('paid_at')->nullable();
            $table->string('paid_by', 50)->nullable();
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
        Schema::dropIfExists(self::TABLE);
    }
};
