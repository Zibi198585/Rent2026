<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address_line_1',
        'address_line_2',
        'post_code',
        'city',
        'province',
        'country',
        'phone_number',
        'email',
        'established_date',
        'notes',
    ];
}
