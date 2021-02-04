<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Konten\Entities\Anime;
use Modules\Konten\Entities\Episode;
use Modules\Konten\Entities\GenreAnime;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
    	$banner = Anime::with('episode')->whereNull('deleted_at')->whereNotNull('banner')->where('publish', 'Publish')->inRandomOrder()->take(3)->get();
    	$ongoing = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->where('status', 'On Going')->orderBy('created_at', 'DESC')->take(6)->get();
    	$popular = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->orderBy('rating', 'DESC')->take(6)->get();
    	$recent = Episode::with('anime')->whereNull('deleted_at')->orderBy('created_at', 'DESC')->take(6)->get();
    	$recommended = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->inRandomOrder()->limit(5)->get();
    	// return $recommended;
        return view('frontend::home.index')->with([
            'ongoing'     => $ongoing,
            'popular'     => $popular,
            'recent'      => $recent,
            'banner'      => $banner,
            'recommended' => $recommended,
            'genre'       => GenreAnime::get(),
        ]);
    }

    public function detail($slug)
    {
    	$anime_detail = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->where('slug', $slug)->get();
    	// return $anime_detail;
        return view('frontend::home.detail')->with([
            'anime_detail' => $anime_detail,
        ]);
    }

    public function ongoing()
    {
        $ongoing = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->where('status', 'On Going')->orderBy('created_at', 'DESC')->paginate(9);
        $recommended = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->inRandomOrder()->limit(5)->get();
    	
        return view('frontend::home.ongoing')->with([
            'ongoing'     => $ongoing,
            'recommended' => $recommended,
            'genre'       => GenreAnime::get(),
        ]);
    }

    public function popular()
    {
        $popular = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->orderBy('rating', 'DESC')->take(6)->paginate(9);
        $recommended = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->inRandomOrder()->limit(5)->get();
        
        return view('frontend::home.popular')->with([
            'popular'     => $popular,
            'recommended' => $recommended,
            'genre'       => GenreAnime::get(),
        ]);
    }

     public function recent()
    {
        $recent = Episode::with('anime')->whereNull('deleted_at')->orderBy('created_at', 'DESC')->paginate(9);
        $recommended = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->inRandomOrder()->limit(5)->get();
        
        return view('frontend::home.recent')->with([
            'recent'      => $recent,
            'recommended' => $recommended,
            'genre'       => GenreAnime::get(),
        ]);
    }


    public function watch($anime, $episode)
    {   
        $episode = Episode::with('anime')->whereNull('deleted_at')->where('slug',$episode)->get();
        $anime = Anime::withCount('episode')->with('episode')->where('slug',$anime)->get();

        return view('frontend::watch.index')->with([
            'episode' => $episode,
            'anime' => $anime,
        ]);
    }


    public function search(Request $request)
    {
        $data = Anime::with('episode')->whereNull('deleted_at')->where('title', 'like', "%" . $request->search . "%")->where('publish', 'Publish')->orderBy('created_at', 'DESC')->paginate(8);

        return view('frontend::home.search')->with([
            'data'   => $data,
            'search' => $request->search,
            'genre'  => GenreAnime::get(),
        ]);
    }

    public function genre()
    {
        return view('frontend::home.genre')->with([
            'genre' => GenreAnime::get(),
        ]);
    }

    public function genreDetail(GenreAnime $genre)
    {
        $id = [];
        $anime = Anime::with('episode')->where('publish', 'Publish')->get();
        foreach($anime as $arr_anime){
            if(in_array($genre->name, $arr_anime->genre)){
                array_push($id, $arr_anime->id);
            }
        }

        $data = Anime::with('episode')->whereNull('deleted_at')
                ->whereIn('id', $id)
                ->where('publish', 'Publish')
                ->orderBy('created_at', 'DESC')
                ->paginate(8);

        return view('frontend::home.genre_detail')->with([
            'data'  => $data,
            'genre' => GenreAnime::get(),
            'genre_name' => $genre->name
        ]);
    }
}
