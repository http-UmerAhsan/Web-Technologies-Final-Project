<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;
    protected $fillable = ['order_number','customer_name','customer_email','customer_phone','address','city','province','postal_code','payment_method','subtotal','shipping','tax','total','status','notes'];
    protected $casts = ['subtotal'=>'decimal:2','shipping'=>'decimal:2','tax'=>'decimal:2','total'=>'decimal:2'];
    const STATUSES = ['Pending','Processing','Shipped','Delivered','Cancelled'];

    public function items() { return $this->hasMany(OrderItem::class); }
    public function getFormattedTotalAttribute(): string { return 'Rs. '.number_format($this->total,0); }
    public function getFormattedSubtotalAttribute(): string { return 'Rs. '.number_format($this->subtotal,0); }
    public function getStatusBadgeAttribute(): string {
        $classes = ['Delivered'=>'status-delivered','Shipped'=>'status-shipped','Processing'=>'status-processing','Pending'=>'status-pending','Cancelled'=>'status-cancelled'];
        $class = $classes[$this->status] ?? 'status-processing';
        return '<span class="status-badge '.$class.'">'.$this->status.'</span>';
    }
    protected static function boot() {
        parent::boot();
        static::creating(function($order) {
            $order->order_number = 'ORD-'.strtoupper(substr(uniqid(),-6));
        });
    }
}
