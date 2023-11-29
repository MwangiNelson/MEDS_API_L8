<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;

    protected $table = 'tbl_users';
    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_role',
        'user_token'
    ];

    /**
    * @var array<int, string>
    */
   protected $hidden = [
       'user_password',
       'remember_token',
   ];

      /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
