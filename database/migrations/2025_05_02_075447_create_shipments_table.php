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
    Schema::create('shipments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('invoice');
        $table->string('cwb');
        $table->string('origin');
        $table->string('destination');
        $table->date('date');
        $table->string('customer_id');
        $table->string('company_name');
        $table->string('receiver_name');
        $table->string('type');
        $table->integer('qty');
        $table->decimal('weight', 10, 2);
        $table->decimal('subtotal', 15, 2);
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
