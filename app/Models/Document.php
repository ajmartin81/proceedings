<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['title','name','url','proceeding_id','user_id','visible'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function proceeding()
    {
        return $this->belongsTo('App\Models\Proceeding');
    }
}
