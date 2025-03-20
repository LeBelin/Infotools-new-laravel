<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{                   
    use HasFactory;

    protected $fillable =[
        'nomClient', 'prenomClient', 'emailClient', 'telephoneClient', 'adresseClient', 'typeClient', 'dateCreationClient', 'idCommerciaux'
        ];

    protected $primaryKey = 'idClient'; // Si la clé primaire n'est pas `id`
}