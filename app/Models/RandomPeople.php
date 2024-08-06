<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomPeople extends Model
{
    protected $fillable = [
        'id', 'uid', 'password', 'first_name', 'last_name', 'username', 'email', 'avatar', 'gender', 'phone_number',
        'social_insurance_number', 'date_of_birth', 'employment_title', 'employment_key_skill', 'address_city',
        'address_street_name', 'address_street_address', 'address_zip_code', 'address_state', 'address_country',
        'address_lat', 'address_lng', 'credit_card_cc_number', 'subscription_plan', 'subscription_status',
        'subscription_payment_method', 'subscription_term',
    ];
}
