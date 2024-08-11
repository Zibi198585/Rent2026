<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Contractor extends Model
{

    use SoftDeletes;
    use HasFactory;

    // Wskazanie na tabelę 'contractors'
    protected $table = 'contractors';

    // Atrybuty, które można masowo przypisać
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'address_line_1',
        'address_line_2',
        'post_code',
        'city',
        'province',
        'country',
        'phone_number',
        'email',
        'pesel',
    ];


}
