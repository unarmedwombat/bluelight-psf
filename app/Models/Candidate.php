<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Candidate extends Model
{
    protected $guarded = ['id'];
    public function opportunity() { return $this->belongsTo(Opportunity::class); }
    public function contractor() { return $this->belongsTo(Contractor::class); }

    public function getFullTitleAttribute()
    {
        $title = $this->opportunity->lot->fullTitle . ', ' . $this->opportunity->region->title;
    }
}
