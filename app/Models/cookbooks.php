<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cookbooks extends Model
{
    use HasFactory;

    protected $table = 'cookbooks';
    protected $fillable = ['user_id', 'saved_recipes'];
}
