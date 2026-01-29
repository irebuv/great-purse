<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{   
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    protected $fillable = ['name', 'pros', 'cons', 'content', 'product_id', 'user_id', 'evaluation', 'reviews'];

    protected $table = 'reviews';
}