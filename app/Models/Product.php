<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;
    protected $fillable = ['name','subtitle','category','price','old_price','description','rating','stock','badge','colors','sizes','images'];
    protected $casts = ['colors'=>'array','sizes'=>'array','images'=>'array','price'=>'decimal:2','old_price'=>'decimal:2'];

    public function orderItems() { return $this->hasMany(OrderItem::class); }
    public function getPrimaryImageAttribute(): string {
        $imgs = $this->images ?? [];
        return $imgs[0] ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80&auto=format&fit=crop';
    }
    public function getFormattedPriceAttribute(): string { return 'Rs. '.number_format($this->price,0); }
    public function getFormattedOldPriceAttribute(): ?string { return $this->old_price ? 'Rs. '.number_format($this->old_price,0) : null; }
    public function getDiscountPercentAttribute(): ?int {
        if (!$this->old_price || $this->old_price <= $this->price) return null;
        return round((1 - $this->price / $this->old_price) * 100);
    }
    public function scopeInStock($q) { return $q->where('stock','>',0); }
    public function scopeByCategory($q, string $cat) { return $q->where('category',$cat); }
}
