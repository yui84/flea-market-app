<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    //Commentは一人のUserに属している
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //CommentはひとつのItemに属している
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
