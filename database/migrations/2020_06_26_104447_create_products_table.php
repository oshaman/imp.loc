<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->foreignId('id');
            $table->foreignId('category_id');
            $table->string('code')->nullable()->default(null);
            $table->boolean('delivery')->default(0);
            $table->string('description')->nullable()->default(null);
            $table->string('guarantee')->nullable()->default(null);
            $table->timestamp('modified_time')->nullable()->useCurrent();
            $table->string('name');
            $table->string('picture');
            $table->string('currency_id')->nullable()->default(null);
            $table->decimal('price', 8, 2)->nullable()->default(null);
            $table->string('stock')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->string('vendor')->nullable()->default(null);

            $table->unique('id');
            $table->index(['price', 'category_id', 'modified_time', 'stock']);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
}
