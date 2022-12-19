<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lot extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = ['id'];

    protected $appends = ['full_title'];

    public function framework()     { return $this->belongsTo(Framework::class); }
    public function category()      { return $this->belongsTo(Category::class); }
    public function opportunities() { return $this->hasMany(Opportunity::class); }
    public function regions()       { return $this->belongsToMany(Region::class, 'opportunities'); }
    public function organisation()  { return $this->belongsToThrough(Organisation::class, Framework::class); }

    public function setMinValueAttribute($value)
    {
        $this->attributes['min_value'] = ($value) ? cleanNumber($value) : 0;
    }
    public function setMaxValueAttribute($value)
    {
        $this->attributes['max_value'] = ($value) ? cleanNumber($value) : 10**9;
    }

    public function getFullTitleAttribute()
    {
        $value = ($this->attributes['title']) ? $this->attributes['title'] . ' ' : '';
        $value .= ($this->attributes['min_value']) ? humanCurrency($this->attributes['min_value']) : '£0';
        $value .= ($this->attributes['max_value'] < 1000000000) ? ' - ' . humanCurrency($this->attributes['max_value']) : ' +';
        return $value;
    }

    public function getExtendedTitleAttribute()
    {
        return $this->framework->organisation->title . ', '
            . $this->framework->title . ' - '
            . $this->getFullTitleAttribute();
    }

    public function getUniqueTitleAttribute()
    {
        $ft = $this->getFullTitleAttribute();
        return (strlen($ft) <= 26)
            ? $ft . ' (' . $this->attributes['id']
            : Str::of($ft)->limit(26, '')->beforeLast(' ') . ' (' . $this->attributes['id'];
    }

}
