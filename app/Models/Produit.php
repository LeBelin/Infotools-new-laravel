<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ['nom_produit', 'description', 'prix', 'stock', 'created_at', 'updated_at'];

    // Other model methods and properties
    //public function commandes()
    //{
    //    return $this->hasMany(Commande::class);
    //}
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

}
