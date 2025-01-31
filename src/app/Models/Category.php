<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['type'];

    /**一つのカテゴリーが複数の商品に対して選択される可能性がある */
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
