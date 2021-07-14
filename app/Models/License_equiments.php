<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License_equiments extends Model
{
    use HasFactory;

    protected $table = 'license_equiments';

    protected $fillable = [
        'license_info_id',
        'equiment_id',
    ];
}
