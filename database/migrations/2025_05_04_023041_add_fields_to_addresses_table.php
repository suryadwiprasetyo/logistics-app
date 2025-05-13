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
    Schema::table('addresses', function (Blueprint $table) {
        $table->string('address_line')->nullable()->after('user_id');
        $table->string('city')->nullable()->after('address_line');
        $table->string('province')->nullable()->after('city');
        $table->string('postal_code')->nullable()->after('province');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('addresses', function (Blueprint $table) {
        $table->dropColumn(['address_line', 'city', 'province', 'postal_code']);
    });
}
};
