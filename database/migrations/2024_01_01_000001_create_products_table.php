<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('products', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('subtitle');
            $table->string('category');
            $table->decimal('price',10,2);
            $table->decimal('old_price',10,2)->nullable();
            $table->text('description');
            $table->string('rating')->nullable();
            $table->integer('stock')->default(0);
            $table->string('badge')->nullable();
            $table->json('colors')->nullable();
            $table->json('sizes')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('products'); }
};
