<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->char('product_code', 3);
            $table->string('name', 50);
            $table->decimal('price', 5, 2);
            $table->timestamps();
        });

        $this->loadData();
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

    public function loadData()
    {

        DB::table('products')->insert([
            [
                'product_code' => 'FR1',
                'name'         => 'Fruit tea',
                'price'        => 3.11,
            ],
            [
                'product_code' => 'SR1',
                'name'         => 'Strawberries',
                'price'        => 5.00,
            ],
            [
                'product_code' => 'CF1',
                'name'         => 'Fruit tea',
                'price'        => 11.23,
            ],
        ]);
    }
}
