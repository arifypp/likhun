<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('our_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique()->nullable();
            $table->string('slug', 100)->unique()->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('connection')->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_packages');
    }
};
