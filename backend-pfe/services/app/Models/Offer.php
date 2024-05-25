<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'client_id',
        'budget',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'client_id');
    }
    
}
