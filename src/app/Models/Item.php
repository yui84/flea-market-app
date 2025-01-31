<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    /**一つの商品が複数のカテゴリーを獲得する可能性あり */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item', 'item_id', 'category_id');
    }

    /**一つの商品は一つの状態に紐づく */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    //Itemは一人のUserに属している
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Itemは複数のLikeを持っている
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Itemは複数のCommentを持っている
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //商品が購入済みか否か
    public function isSold()
    {
        return $this->purchases()->exists();
    }

    /**一つの商品は一人のユーザーから購入される可能性がある */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}