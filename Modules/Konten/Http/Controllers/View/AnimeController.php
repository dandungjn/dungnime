<?php

namespace Modules\Konten\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Konten\Entities\Anime;
use Modules\Konten\Http\Controllers\Helper\AnimeHelper;

class AnimeController extends Controller
{
    /**
     * BeritaController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('anime.index'), 'text' => 'Anime'],
        ];

        $this->helper = new AnimeHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Judul',
                "align" => 'center',
                "sortable" => false,
                "value" => 'title',
            ],
            [
                "text" => 'Thumbnail',
                "align" => 'center',
                "sortable" => false,
                "value" => 'thumbnail',
            ],
            [
                "text" => 'Rating',
                "align" => 'center',
                "sortable" => false,
                "value" => 'rating',
            ],
            [
                "text" => 'Status',
                "align" => 'center',
                "sortable" => false,
                "value" => 'status',
            ],
            [
                "text" => 'Publish',
                "align" => 'center',
                "sortable" => false,
                "value" => 'publish',
            ],
            [
                "text" => 'Tanggal Publish',
                "align" => 'center',
                "sortable" => false,
                "value" => 'publish_date',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('konten::anime.index')
             ->with('page_title', 'Anime')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('anime.create'), 'text' => 'Tambah Anime '];

        return view('konten::anime.create')
             ->with('page_title', 'Tambah Anime')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param Berita $berita
     * @return Renderable
     */
    public function edit(Anime $anime)
    {
        $this->breadcrumbs[] = ['href' => route('anime.edit', [ $anime->slug ]), 'text' => 'Edit Anime '. $anime->title];

        return view('konten::anime.edit')
             ->with('data', $anime)
             ->with('page_title', 'Edit Anime '. $anime->title)
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }

    public function show(Anime $anime)
    {
        return redirect()->route('anime.episode.index', ['anime' => $anime]);
    }
}
