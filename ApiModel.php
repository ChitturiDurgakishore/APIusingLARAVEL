<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class ApiModel extends Model
{
    use HasApiTokens;
    protected $table  ="students";

    protected $fillable = ['name',
        'email',
        'password',
        'phone'
    ];
    public $timestamps = false;
}

