<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserManagementModel extends Model
{
    use HasFactory;
    protected $table = 'user_management';
    protected $fillable =[
        'firstname',
        'middlename',
        'lastname',
        'id_number'
    ];
}
