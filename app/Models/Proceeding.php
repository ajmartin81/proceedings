<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceeding extends Model
{
    use HasFactory;

    protected $fillable = ['reference','description','site','status', 'begin_at','end_at'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document')->withTimestamps();
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event')->withTimestamps();
    }

    public function annotations()
    {
        return $this->hasMany('App\Models\Annotation')->withTimestamps();
    }
}
