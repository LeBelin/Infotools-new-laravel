<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $fillable = ['nom', 'email', 'telephone', 'adresse', 'created_at'];

    // Other model methods and properties

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
