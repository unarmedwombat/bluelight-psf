<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function frameworks() { return $this->belongsToMany(Framework::class); }
    public function lots() { return $this->belongsToMany(Lot::class, 'opportunities'); }
}
