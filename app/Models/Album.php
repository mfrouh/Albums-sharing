<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table='albums';

    protected $fillable=['name','user_id','type'];

    protected $appends=['image'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function gallery()
    {
        return $this->morphMany('App\Models\Image','imageable');
    }

    public function ScopePublic($q)
    {
        return $q->where('type','public');
    }

    public function ScopePrivate($q)
    {
        return $q->where('type','private');
    }
    public function getImageAttribute()
    {
        return $this->gallery()->count()!=0 ? $this->gallery()->pluck('url')[0]:'images/demo1.png';
    }

}
