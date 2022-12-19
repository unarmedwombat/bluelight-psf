<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Framework extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = ['expiry' => 'date', 'is_dps' => 'boolean'];

    public function organisation()  { return $this->belongsTo(Organisation::class); }
    public function regions()       { return $this->belongsToMany(Region::class); }
    public function lots()          { return $this->hasMany(Lot::class); }
    public function contractors()   { return $this->belongsToMany(Contractor::class); }
    public function updated_by()    { return $this->belongsTo(User::class, 'updated_by_id'); }
    public function deleted_by()    { return $this->belongsTo(User::class, 'deleted_by_id'); }

    public function getFullTitleAttribute(): string
    {
        return $this->organisation->title . ', ' . $this->attributes['title'];
    }

    public function getAllDescriptions(): array
    {
        $result = (new Framework)->with('organisation')->get();
        $arr = $result->pluck('fullTitle', 'id')->toArray();
        asort($arr);
        return $arr;
    }

    public function getContact()
    {
        return ($this->contact) ? $this->contact : $this->organisation->contact;
    }

    public function getJobTitle()
    {
        return ($this->job_title) ? $this->job_title : $this->organisation->job_title;
    }

    public function getPhone()
    {
        return ($this->phone) ? $this->phone : $this->organisation->phone;
    }

    public function getEmail()
    {
        return ($this->email) ? $this->email : $this->organisation->email;
    }
}
