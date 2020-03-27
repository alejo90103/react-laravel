<?php
# @Author: Codeals
# @Date:   20-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 26-11-2019
# @Copyright: Codeals

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['Cell', 'Nauta'])->defatul('Cell');
            $table->bigInteger('offer_id')->unsigned();
            $table->foreign('offer_id')
                  ->references('id')
                  ->on('offers')
                  ->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->date('date_recharge');
            $table->float('price_pay', 8, 2);
            $table->float('recharge_amount', 8, 2);
            $table->enum('status', ['Waiting', 'Cancel', 'Accepted', 'Denied', 'Scheduled'])->defatul('Waiting');
            $table->boolean('is_deleted')->default(0);
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
        Schema::dropIfExists('recharges');
    }
}
