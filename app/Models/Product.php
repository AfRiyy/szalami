<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'ingredient_id', 'manufacture_date'];
}
