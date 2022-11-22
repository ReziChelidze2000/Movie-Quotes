<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
        if (Quote::all()->isNotEmpty()) {
            $quote = Quote::all()->random();
            $movie = $quote->movie;
            $director = $movie->director ?? null;

            return view('guest.index', [
                'quote' => $quote,
                'director' => $director,
                'movie' => $movie
            ]);
        }

        return view('guest.empty');

    }

    public function directors()
    {
        $data = Director::withCount('quotes')->orderBy('quotes_count', 'desc')->limit(3)->get();

        return view('guest.top', [
            'data' => $data
        ]);
    }

    public function show(Movie $movie)
    {
        return view('guest.movie', [
            'movie' => $movie,
            'quotes' => $movie->quotes,
            'director' => $movie->director
        ]);
    }

}
