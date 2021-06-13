<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','start','end', 'proceeding_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function proceeding()
    {
        return $this->belongsTo('App\Models\Proceeding');
    }
}
