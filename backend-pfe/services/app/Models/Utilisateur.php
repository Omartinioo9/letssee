<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable {
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role', 'status', 
        'email_verified_at', 'programming_languages', 'frameworks', 'experience',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function offers() {
        return $this->hasMany(Offer::class, 'client_id');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'user_id');
    }
}
