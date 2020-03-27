<?php
# @Author: Codeals
# @Date:   20-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   alejandro
# @Last modified time: 2019-11-23T20:01:16+01:00
# @Copyright: Codeals

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_recharges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('recharge_id')->unsigned();
            $table->foreign('recharge_id')
                  ->references('id')
                  ->on('recharges')
                  ->onDelete('cascade');
            $table->bigInteger('contact_id')->unsigned();
            $table->foreign('contact_id')
                  ->references('id')
                  ->on('contacts')
                  ->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            // $table->bigInteger('contact_id')->nullable();
            $table->string('message');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('contact_recharges');
    }
}
