<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;

class Category extends Model
{
    public function todos() {
        return $this->hasMany(Todo::class);
    }
}
