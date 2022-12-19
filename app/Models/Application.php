<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($application) {
            $application->attributes['password'] = generatePassword();
        });
    }

}
