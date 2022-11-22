<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $movies = Movie::withCount('quotes')->orderBy('created_at', 'desc')->paginate(10);

        return view('movies.index', [
            'data' => $movies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('movies.create', [
            'directors' => Director::all('id', 'first_name', 'last_name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(MovieRequest $request)
    {
        $data = $request->validated();

        Movie::create([
            'title' => $data['title'],
            'director_id' => $data['director_id'] ?? null,
            'image' => isset($data['image']) ? $data['image']->store('public/images/movies') : null
        ]);

        return redirect('/movies')->with('message', 'Added movie');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', [
            'movie' => $movie,
            'directors' => Director::all('id', 'first_name', 'last_name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $validated = $request->validated();

        if (isset($validated['image'])) {
            if ($movie->image) Storage::delete($movie->image);
            $movie->update(['image' => $validated['image']->store('public/images/movies')]);
        }

        $movie->update([
            'title' => $validated['title'],
            'director_id' => $validated['director_id'] ?? null
        ]);

        return redirect('/movies')->with('message', 'movie has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Movie $movie)
    {
        if ($movie->image) Storage::delete($movie->image);
        $movie->delete();

        return redirect()->back()->with('message', 'movie has been deleted');
    }
}
