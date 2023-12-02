<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    public $table = 'goods';
    protected $fillable = [ 'name', 'category_id', 'quantity', 'size', 'weight', 'amount' ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
