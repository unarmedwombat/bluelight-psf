<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $guarded = ['id'];

    protected $with = ['lot.framework.organisation', 'region'];

    protected $appends = ['full_title'];

    public $timestamps = false;

    public function lot() { return $this->belongsTo(Lot::class); }
    public function region() { return $this->belongsTo(Region::class); }

    public function contractors() { return $this->belongsToMany(Contractor::class, 'candidates')->withTimestamps(); }

    public function getFullTitleAttribute()
    {
        return $this->lot->extendedTitle . ', ' . $this->region->title;
    }

}
