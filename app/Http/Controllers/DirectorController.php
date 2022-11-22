<?php

namespace App\Http\Controllers;

use App\Http\Requests\DirectorRequest;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $directors = Director::withCount('movies')->orderBy('created_at', 'desc')->paginate(5);

        return view('directors.index', [
            'data' => $directors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('directors.create', [
            'movies' => Movie::where('director_id', null)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DirectorRequest $request)
    {
        $validated = $request->validated();

        $director = Director::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name']
        ]);

        $movies = $validated['movies'] ?? null;

        if ($movies) {
            foreach ($movies as $item) {
                $movie = Movie::where('id', $item)->first();
                $movie->director()->associate($director);
                $movie->save();
            }
        }

        return redirect('/directors')->with('message', 'New director added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Director $director
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Director $director)
    {
        $movies = Movie::where('director_id', null)
            ->orWhere('director_id', $director->id)
            ->get();

        return view('directors.edit', [
            'director' => $director,
            'movies' => $movies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Director $director
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(DirectorRequest $request, Director $director)
    {
        $validated = $request->validated();

        $movies = $validated['movies'] ?? null;

        if ($movies) {
            foreach ($movies as $item) {
                $movie = Movie::find($item)->director()->associate($director);
                $movie->save();
            }
        } else {
            $director->movies()->update(['director_id' => null]);
        }

        $director->update($validated);

        return redirect('/directors')->with('message','director updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Director $director
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Director $director)
    {
        $director->delete();
        $director->movies()->update(['director_id' => null]);
        return redirect()->back()->with('message', 'director has deleted');
    }
}
