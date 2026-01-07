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
        Schema::create('bidder_bid_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bid_id')->constrained('bids')->onDelete('cascade');
            $table->foreignId('bidder_id')->constrained('bidders')->onDelete('cascade');
            $table->foreignId('lot_item_id')->constrained('lot_items')->onDelete('cascade');
            $table->float('unit_price', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidder_bid_items');
    }
};
