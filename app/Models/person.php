<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = [
        'uid', 'password', 'first_name', 'last_name', 'username', 'email', 'avatar', 'gender', 'phone_number',
        'social_insurance_number', 'date_of_birth', 'employment_title', 'employment_key_skill', 'address_city',
        'address_street_name', 'address_street_address', 'address_zip_code', 'address_state', 'address_country',
    ];

}
