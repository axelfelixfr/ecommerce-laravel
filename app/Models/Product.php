<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $fillable = ['name', 'price', 'description', 'image_url'];

    public function url()
    {
        return $this->id ? 'products.update' : 'products.store';
    }

    public function method()
    {
        return $this->id ? 'PUT' : 'POST';
    }
}
