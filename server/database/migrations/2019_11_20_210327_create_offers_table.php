<?php
# @Author: Codeals
# @Date:   20-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 24-11-2019
# @Copyright: Codeals

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('type', ['Cell', 'Nauta'])->defatul('Cell');
            $table->boolean('ads')->default(0);
            $table->date('date_ini')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_expire');
            $table->float('price_pay', 8, 2);
            $table->string('receive');
            $table->float('recharge_amount', 8, 2);
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
        Schema::dropIfExists('offers');
    }
}
