<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ['nom_produit', 'description', 'prix', 'stock', 'created_at', 'updated_at'];

    // Other model methods and properties
}
