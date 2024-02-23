<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("restaurant_id")->nullable();
            $table->foreign("restaurant_id")->references("id")->on("restaurants")->nullOnDelete();
            $table->string('name', 50);
            $table->text('description');
            $table->decimal('price', 5,2);
            $table->tinyText('img') ->nullable();
            $table->boolean("visibility")->default(true);
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
        Schema::dropIfExists('dishes');
    }
};
