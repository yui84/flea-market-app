<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    //Likeは一人のUserに属している
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //LikeはひとつのItemに属している
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
