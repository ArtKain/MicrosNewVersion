<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','type',
      ];

    public function users() {
        return $this->belongsToMany(User::class, 'category_user' , 'user_id', 'category_id');
    }

    public function recording() {
        return $this->hasMany(Recording::class);
    }
}
