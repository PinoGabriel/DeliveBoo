<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("restaurant_id")->nullable();
            $table->foreign("restaurant_id")->references("id")->on("restaurants")->nullOnDelete();
            $table->string('status', 50);
            $table->string('client_name', 50);
            $table->string('client_surname', 50);
            $table->string('client_mail', 100);
            $table->string('client_phone', 164);
            $table->text('client_address');
            $table->double('total', 6, 2)->default(0);
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
        Schema::dropIfExists('orders');
    }
};
