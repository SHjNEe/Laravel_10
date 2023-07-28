<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeTitle(Builder $query, string $title): Builder |QueryBuilder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }
    public function scopePopular(Builder $query, $from = null, $to = null): Builder |QueryBuilder
    {
        // return $query->withCount('reviews')->orderBy('reviews_count', 'desc');
        return $query->withCount(['reviews' => function (Builder $q) use ($from, $to) {
            if ($from && !$to) {
                $q->where('created_at', '>=', $from);
            } else if (!$from && $to) {
                $q->where('created_at', '<=', $to);
            } else {
                $q->where('created_at', [$from, $to]);
            }
        }])->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRated(Builder $query): Builder | QueryBuilder
    {
        return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
    }
}
