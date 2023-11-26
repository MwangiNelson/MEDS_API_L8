<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recipes extends Model
{
    use HasFactory;
    
    protected $table = "recipes";
    protected $fillable = ["title", "author", "likes", "description", "image_url", "ingredients"];
}
