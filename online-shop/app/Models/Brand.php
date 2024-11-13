<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function category()
    {
        // Call relational between models brands and categories
        return $this->belongsTo(Category::class);
    }
}
