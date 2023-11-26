<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drugs extends Model
{
    use HasFactory;
    protected $table = "tbl_drugs";
    protected $fillable = ["drug_name", "drug_category", "drug_image", "drug_description", "drug_price", "unit_quantity" , "unit_description"];

}
