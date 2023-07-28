<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['review', 'rating'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
