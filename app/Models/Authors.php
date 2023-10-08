<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;
    protected $fillable = [
        'apiAuthorId',
        'firstName',
        'lastName',
        'birthday',
        'gender',
        'placeOfBirth',
    ];

    public function books()
    {
        // return $this->hasMany('App\Models\Books');
    }
}
