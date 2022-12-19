<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $table = 'organisations';

    protected $guarded = ['id'];

    public function frameworks() { return $this->hasMany(Framework::class); }

}
