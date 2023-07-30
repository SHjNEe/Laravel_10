<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');

        $books = Book::when(
            $title,
            fn ($query, $title) => $query->title($title)
        );
        if (empty($filter)) {
            $books->withReviewCountAndAvgRating();
        }

        $books = match ($filter) {
            'latest' =>  $books->withReviewCountAndAvgRating()->latest(),
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->latest()
        };
        // $books = $books->get();
        //Cache
        $cacheKey = 'books:' . $filter . ':' . $title;
        $books = cache()->remember($cacheKey, 3600, function () use ($books) {
            $books->get();
        });
        // Cache::remember($cacheKey, 3600, fn () => $books->get());

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(Book $book)
    {
        // $book = $book->load([
        //     'reviews' => fn ($query) => $query->latest()
        // ]);
        // return view(
        //     'books.show',
        //     [
        //         'book' => $book
        //     ]
        // );
        $cacheKey = 'book:' . $book->id;
        $book = cache()->remember($cacheKey, 3600, fn () =>  $book->load([
            'reviews' => fn ($query) => $query->latest()
        ]));
        // $book = $book->load([
        //     'reviews' => fn ($query) => $query->latest()
        // ]);
        // $reviewsCount = $book->reviews->count();
        // $averageRating = $book->reviews->avg('rating');

        // return view('books.show', [
        //     'book' => $book,
        //     'reviewsCount' => $reviewsCount,
        //     'averageRating' => $averageRating,
        // ]);

        $book->reviewsCount =  $book->reviews->count();
        $book->averageRating =  $book->reviews->avg('rating');

        return view('books.show', [
            'book' =>  $book
        ]);
    }
    // public function show(Book $book)
    // {
    //     $bookWithReviews = $book->with([
    //         'reviews' => fn ($query) => $query->latest()
    //     ])->withCount('reviews')->withAvg('reviews', 'rating')->first();

    //     return view('books.show', ['book' => $bookWithReviews]);
    // }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
