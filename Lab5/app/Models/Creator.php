<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creator extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email'];

    public $timestamps = true;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
