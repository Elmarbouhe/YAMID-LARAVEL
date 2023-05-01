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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->String("title");
            $table->String("slug", 191)->unique();
            $table->String("description");
            $table->decimal("price", 8, 2);
            $table->decimal("old_price", 8, 2)->nullable();
            $table->integer("inStock");
            $table->String("image");
            $table->foreignId("category_id")->uncigned();

            $table->timestamps();
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
