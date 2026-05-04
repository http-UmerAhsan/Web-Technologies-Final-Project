<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = ['name','email','phone','city','province','total_orders','total_spent'];
    protected $casts = ['total_spent'=>'decimal:2'];
    public function getFormattedTotalSpentAttribute(): string { return 'Rs. '.number_format($this->total_spent,0); }
}
