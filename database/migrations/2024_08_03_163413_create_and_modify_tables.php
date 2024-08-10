<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAndModifyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('cart_id');
                $table->integer('status');
                $table->unsignedBigInteger('user_shipping_information_id')->nullable();
                $table->unsignedBigInteger('user_details_id')->nullable();
                $table->unsignedBigInteger('delivery_service_id')->default(0);
                $table->softDeletes();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->integer('price');
                $table->unsignedBigInteger('category_id')->nullable();
                $table->integer('quantity')->default(0);
                $table->text('hex_code');
                $table->boolean('is_active')->default(true);
                $table->text('preview_image')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('product_id');
                $table->text('content');
                $table->softDeletes();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->text('preview_image')->nullable();
                $table->boolean('is_active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('carts')) {
            Schema::create('carts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('order_id')->nullable();
                $table->string('session')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('product_images')) {
            Schema::create('product_images', function (Blueprint $table) {
                $table->id();
                $table->string('image_path');
                $table->unsignedBigInteger('product_id');
                $table->integer('sort_order')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('user_shipping_informations')) {
            Schema::create('user_shipping_informations', function (Blueprint $table) {
                $table->id();
                $table->text('type');
                $table->unsignedBigInteger('user_id');
                $table->text('value');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('special_offers')) {
            Schema::create('special_offers', function (Blueprint $table) {
                $table->id();
                $table->string('header');
                $table->string('description');
                $table->string('image');
                $table->integer('sort_order');
                $table->string('hex_code')->default('#f7f7f7');
                $table->boolean('is_active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('cart_products')) {
            Schema::create('cart_products', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cart_id')->nullable();
                $table->unsignedBigInteger('product_id')->nullable();
                $table->integer('quantity')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('user_details')) {
            Schema::create('user_details', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('name');
                $table->string('email');
                $table->string('phone_number')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('user_shipping_informations');
        Schema::dropIfExists('special_offers');
        Schema::dropIfExists('cart_products');
        Schema::dropIfExists('user_details');
    }
}
