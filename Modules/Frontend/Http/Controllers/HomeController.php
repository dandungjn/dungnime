<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Konten\Entities\Anime;
use Modules\Konten\Entities\Episode;
use Illuminate\Support\Str;

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
            'ongoing' => $ongoing,
            'popular' => $popular,
            'recent' => $recent,
            'banner' => $banner,
            'recommended' => $recommended,
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
            'ongoing' => $ongoing,
            'recommended' => $recommended,
        ]);
    }

    public function popular()
    {
        $popular = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->orderBy('rating', 'DESC')->take(6)->paginate(9);
        $recommended = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->inRandomOrder()->limit(5)->get();
        
        return view('frontend::home.popular')->with([
            'popular' => $popular,
            'recommended' => $recommended,
        ]);
    }

     public function recent()
    {
        $recent = Episode::with('anime')->whereNull('deleted_at')->orderBy('created_at', 'DESC')->paginate(9);
        $recommended = Anime::with('episode')->whereNull('deleted_at')->where('publish', 'Publish')->inRandomOrder()->limit(5)->get();
        
        return view('frontend::home.recent')->with([
            'recent' => $recent,
            'recommended' => $recommended,
        ]);
    }

    public function watch()
    {
        
        return view('frontend::watch.index');
    }


    public function search(Request $request)
    {
        $data = Anime::with('episode')->whereNull('deleted_at')->where('title', 'like', "%" . $request->search . "%")->where('publish', 'Publish')->orderBy('created_at', 'DESC')->paginate(8);

        return view('frontend::home.search')->with([
            'data'   => $data,
            'search' => $request->search,
        ]);
    }
}
