<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'creator_id'];

    public $timestamps = true;

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
