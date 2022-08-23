<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'business_name',
        'type_of_operation',
        'distributor_name',
        'email',
        'phone_number',
        'optin'
    ];
}
