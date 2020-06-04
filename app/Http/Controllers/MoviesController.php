<?php

namespace App\Http\Controllers;

use App\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
   
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/popular')
        ->json()['results'];


        $genresArray = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json()['genres'];
        
        $genres = collect($genresArray)->mapWithKeys(function($genre){
            return [$genre['id']=>$genre['name']];
        });

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/now_playing')
        ->json()['results'];

        // dump($nowPlayingMovies);
        return view('index',['popularMovies'=>$popularMovies, 'genres'=>$genres, 'nowPlayingMovies'=>$nowPlayingMovies]);
        
    }

   
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
    }

  
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
        ->json();

        // dump($movie);

        return view('show',['movie'=>$movie]);
    }

   
    public function edit(Movies $movies)
    {
        //
    }

    public function update(Request $request, Movies $movies)
    {
        //
    }

    
    public function destroy(Movies $movies)
    {
        //
    }
}
