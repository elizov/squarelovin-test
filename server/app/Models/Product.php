<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function productAttrubites()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_attribute_values')
            ->withPivot('value');
    }
}
