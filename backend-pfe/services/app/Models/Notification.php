<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
    protected $fillable = ['user_id', 'message', 'developer_id'];

    public function user() {
        return $this->belongsTo(Utilisateur::class, 'user_id');
    }

    public function developer() {
        return $this->belongsTo(Utilisateur::class, 'developer_id');
    }
}
