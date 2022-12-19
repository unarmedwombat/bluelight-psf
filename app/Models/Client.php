<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function users() { return $this->hasMany(User::class); }
    public function region() { return $this->belongsTo(Region::class); }
}
