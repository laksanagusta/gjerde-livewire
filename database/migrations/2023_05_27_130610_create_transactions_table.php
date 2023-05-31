<?php

use App\Models\Location;
use App\Models\Reseller;
use App\Models\TransactionType;
use App\Models\User;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('grandTotal');
            $table->foreignIdFor(Location::class);
            $table->foreignIdFor(TransactionType::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Reseller::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
