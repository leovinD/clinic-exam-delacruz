<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['region_name'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'region_id');
    // }
}
