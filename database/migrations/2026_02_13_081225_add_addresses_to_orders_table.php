<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Infos livraison
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_postal_code')->nullable();
            $table->string('shipping_country')->nullable()->default('Maroc');
            $table->string('shipping_phone')->nullable();

            // Infos facturation (facultatives, sinon = livraison)
            $table->string('billing_name')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_postal_code')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_phone')->nullable();

            // Statut plus propre
            $table->string('status')->default('pending')->change(); // si déjà existant
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_name',
                'shipping_address',
                'shipping_city',
                'shipping_postal_code',
                'shipping_country',
                'shipping_phone',
                'billing_name',
                'billing_address',
                'billing_city',
                'billing_postal_code',
                'billing_country',
                'billing_phone',
            ]);
            // tu peux laisser le status tel quel au down
        });
    }
};