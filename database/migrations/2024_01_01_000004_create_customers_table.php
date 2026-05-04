<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('customers', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->integer('total_orders')->default(0);
            $table->decimal('total_spent',12,2)->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('customers'); }
};
