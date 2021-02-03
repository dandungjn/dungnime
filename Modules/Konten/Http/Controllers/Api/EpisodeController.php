<?php

namespace Modules\Konten\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Konten\Entities\Episode;
use Modules\Konten\Entities\Anime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Excel;

class EpisodeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Anime $anime, Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $request->merge([
                'anime_id' => $anime->id,
            ]);

            $data = Episode::create($request->all());

            DB::commit();
            return response_json(true, null,"Episode Berhasil Disimpan", $data);            
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), "Terjadi kesalahan saat menyimpan data, coba beberapa saat lagi.");
        }
    }


    public function update(Request $request, Episode $episode)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $episode->update($request->all());

            DB::commit();
            return response_json(true, null,"Episode Berhasil Disimpan", $episode);            

        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), "Terjadi kesalahan saat menyimpan data, coba beberapa saat lagi.");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param ListAlumni $alumni
     * @return Renderable
     */
    public function destroy(Episode $episode)
    {
        DB::beginTransaction();
        try {
            
            $episode->delete();
            DB::commit();
            return response_json(true, null, "Episode berhasil dihapus");            
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), "Terjadi kesalahan saat menghapus data, silahkan coba beberapa saat lagi.");
        }
    }

  
    public function data(Episode $episode)
    {
       
        return response_json(true, null, 'Data retrieved', $episode);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'judul' => 'bail|nullable',
        ]);
    }

    /**
     *
     * Get the resources from storage.
     * @return Renderable
     *
     */
    public function table(Anime $anime, Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        $query = Episode::with('anime')->whereHas('anime', function($subquery) use ($anime) {
            $subquery->where('id', $anime->id);
        });


        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('title', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'DESC')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     *
     * Validation Rules for Get Table Data
     *
     */
    public function validateTableRequest($request)
    {
        return Validator::make($request->all(), [
            "page" => "bail|sometimes|required|numeric|min:1",
            "search" => "bail|present|nullable",
            "paginate" => "bail|required|numeric|in:10,20,50,100",
        ]);
    }

    /**
     *
     * Validation Rules for Get Table Data
     *
     */
}
