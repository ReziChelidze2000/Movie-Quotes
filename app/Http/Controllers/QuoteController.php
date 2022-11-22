<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $quotes = Quote::with('movie')->orderBy('created_at', 'desc')->paginate(10);
        return view('quotes.index', [
            'data' => $quotes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $movies = Movie::all('id', 'title');

        return view('quotes.create', [
            'movies' => $movies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(QuoteRequest $request)
    {
        Quote::create($request->validated());
        return redirect('quotes')->with('message', 'Added quote');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Quote $quote
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Quote $quote)
    {
        return view('quotes.edit', [
            'quote' => $quote,
            'movies' => Movie::all('id', 'title')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Quote $quote
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(QuoteRequest $request, Quote $quote)
    {
        $quote->update($request->validated());

        return redirect('/quotes')->with('message', 'Quote has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Quote $quote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();

        return redirect()->back()->with('message', 'Quote has been deleted');
    }
}
