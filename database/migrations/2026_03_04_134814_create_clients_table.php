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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();   
            $table->enum('type', ['individual', 'company']);         
            $table->string('name');
            $table->string('dni_cif', 20)->unique();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable();            

            $table->timestamps();
        });

        //Address
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();

            $table->string('address');
            $table->string('city');
            $table->string('postal_code', 10)->nullable();
            $table->string('province')->nullable();
            $table->string('country')->default('España');

            $table->string('label')->nullable();           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_addresses');
        Schema::dropIfExists('clients');
    }
};
