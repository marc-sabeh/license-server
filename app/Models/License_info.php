<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License_info extends Model
{
    use HasFactory;

    protected $table = 'license_info';

    protected $fillable = [
        'license_features_id',
        'license_key',
        'date_of_purchase',
        'start_date',
        'expiry_date',
    ];
}
