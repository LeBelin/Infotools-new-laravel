<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    protected $fillable = ['client_id', 'commercial_id', 'date_rendez_vous', 'heure_rendez_vous', 'description', 'created_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function commercial()
    {
        return $this->belongsTo(Commercial::class);
    }
    // Si le nom de la table est différent de "rendezvouses"
    protected $table = 'rendez_vous';  // Remplace par le nom correct de la table

}


            