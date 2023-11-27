<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drug_categories extends Model
{
    use HasFactory;
    protected $table = "tbl_categories";
    protected $fillable = ["category_name"];
}
