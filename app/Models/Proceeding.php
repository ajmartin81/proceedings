<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceeding extends Model
{
    use HasFactory;

    protected $fillable = ['reference','title', 'description','site','status', 'begin_at','end_at'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function annotations()
    {
        return $this->hasMany('App\Models\Annotation');
    }
}
