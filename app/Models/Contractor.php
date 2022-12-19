<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $guarded = ['id'];

    public function opportunities() { return $this->belongsToMany(Opportunity::class, 'candidates')->withTimestamps(); }
    public function frameworks() { return $this->belongsToMany(Framework::class); }
}
