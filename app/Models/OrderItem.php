<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
    use HasFactory;
    protected $fillable = ['order_id','product_id','product_name','size','color','quantity','unit_price','total_price'];
    protected $casts = ['unit_price'=>'decimal:2','total_price'=>'decimal:2'];
    public function order() { return $this->belongsTo(Order::class); }
    public function product() { return $this->belongsTo(Product::class); }
    public function getFormattedUnitPriceAttribute(): string { return 'Rs. '.number_format($this->unit_price,0); }
    public function getFormattedTotalPriceAttribute(): string { return 'Rs. '.number_format($this->total_price,0); }
}
