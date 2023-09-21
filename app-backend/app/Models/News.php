<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function scopeCategory($query, $categories)
    {
        return $query->whereIn('category', $categories);
    }

    public function scopeKeyword($query, $keyword)
    {
        return $query->where('title', 'like', '%'.$keyword.'%')
            ->orWhere('content', 'like', '%'.$keyword.'%');
    }

    public function scopeSource($query, $sources)
    {
        return $query->whereIn('source', $sources);
    }

    public function scopeDate($query, $date)
    {
        return $query->where('date', $date);
    }
}
