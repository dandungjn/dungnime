<?php

namespace Modules\Konten\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Konten\Entities\Anime;
use Modules\Konten\Entities\Episode;

class EpisodeController extends Controller
{
    /**
     *  Alumni constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('anime.index'), 'text' => "Anime "],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Anime $anime)
    {
        $table_headers = [
            [
                "text" => 'Title',
                "align" => 'center',
                "sortable" => false,
                "value" => 'title',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];

        $this->breadcrumbs[] = ['href' => route('anime.episode.index',[$anime->slug]), 'text' => "Anime Detail"];
        $this->breadcrumbs[] = ['href' => route('anime.episode.index',[$anime->slug]), 'text' =>  $anime->title ?? '']; 
        return view('konten::episode.index')
            ->with('page_title', 'Episode '. $anime->title)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers)
            ->with('anime', $anime);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Anime $anime)
    {
        return view('konten::episode.create')
            ->with('page_title', 'Tambah Episode '. $anime->title)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('anime', $anime);
    }

    /**
     * Show the form for editing the specified resource.
     * @param KataSambutan $kata_sambutan
     * @return Renderable
     */
    public function edit(Episode $episode)
    {
        $anime = Anime::find($episode->anime_id);
        $this->breadcrumbs[] = ['href' => route('episode.edit', [ $episode->slug ]), 'text' => "Ubah Episode " . $episode->title];

        return view('konten::episode.edit')
            ->with('data', $episode)
            ->with('page_title', "Ubah Episode " . $episode->title)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('anime', $anime);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
}
