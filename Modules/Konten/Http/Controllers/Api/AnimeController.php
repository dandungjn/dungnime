<?php

namespace Modules\Konten\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Konten\Entities\Anime;
use Modules\Konten\Entities\Episode;
use Modules\Konten\Entities\GenreAnime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;


class AnimeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
  public function store(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {


            $array_genre = explode(',', $request->genre);
            foreach ($array_genre as $value_array_genre) {
                $data_genre[] = GenreAnime::firstOrCreate(['name' => $value_array_genre]);
            }

            $data = Anime::create($request->all());

            $data->genre = $array_genre;

             if ($request->hasFile('thumbnail')) {
                $file_name = Str::slug($data->title, '-') .'-'. uniqid() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('anime/thumbnail', $request->file('thumbnail'), $file_name
                );
                $data->thumbnail = $file_name;

            }

             if ($request->hasFile('banner')) {
                $file_name = Str::slug($data->title, '-') .'-'. uniqid() . '.' . $request->file('banner')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('anime/banner', $request->file('banner'), $file_name
                );
                $data->banner = $file_name;

            }
           
            $data->save();

            DB::commit();
            return response_json(true, null,'Anime Berhasil Disimpan', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param anime $anime
     * @return Renderable
     */
    public function update(Request $request, Anime $anime)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $array_genre = explode(',', $request->genre);
            foreach ($array_genre as $value_array_genre) {
                $data_genre[] = GenreAnime::firstOrCreate(['name' => $value_array_genre]);
            }

            $anime->update($request->all());

            $anime->genre = $array_genre;

            if ($request->hasFile('thumbnail')) {
                $file_name = Str::slug($request->title, '-') .'-'. uniqid() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('anime/thumbnail', $request->file('thumbnail'), $file_name
                );
                $anime->thumbnail = $file_name;

            }

            if ($request->hasFile('banner')) {
                $file_name = Str::slug($request->title, '-') .'-'. uniqid() . '.' . $request->file('banner')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('anime/banner', $request->file('banner'), $file_name
                );
                $anime->banner = $file_name;

            }


            $anime->save();


            DB::commit();
            return response_json(true, null,'anime Berhasil Disimpan', $anime); 
        } catch (\Exception $e) {
            DB::rollback();
           return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param anime $anime
     * @return Renderable
     */
    public function destroy(Anime $anime)
    {
        DB::beginTransaction();
        try {

            $anime->delete();

            DB::commit();
            
            return response_json(true, null,'Anime Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollback();
             return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param anime $anime
     * @return Renderable
     */
    public function data(Anime $anime)
    {
        

        return response_json(true, null, 'Data retrieved', $anime);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'title' => 'bail|required|string',
        ]);
    }

    /**
     *
     * Get the resources from storage.
     * @return Renderable
     *
     */
    public function table(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        $query = Anime::query();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('title', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->thumbnail = $item->thumbnail ? get_file_url('public', 'anime/thumbnail/'.$item->thumbnail) : '';
            $item->publish_date = \Carbon\Carbon::parse($item->publish_date)->locale('id')->translatedFormat('d F Y');
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
            'paginate' => 'bail|sometimes|required|numeric|min:5',

        ]);
    }
}
