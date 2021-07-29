<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
      ];

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function recording() {
        return $this->hasMany(Recording::class);
    }
}
