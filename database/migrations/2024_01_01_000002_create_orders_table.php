<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function(Blueprint $table){
            $table->id();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code')->nullable();
            $table->enum('payment_method',['card','easypaisa','cod'])->default('cod');
            $table->decimal('subtotal',10,2)->default(0);
            $table->decimal('shipping',10,2)->default(0);
            $table->decimal('tax',10,2)->default(0);
            $table->decimal('total',10,2)->default(0);
            $table->enum('status',['Pending','Processing','Shipped','Delivered','Cancelled'])->default('Processing');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
