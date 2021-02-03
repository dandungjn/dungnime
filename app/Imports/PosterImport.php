<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Modules\Publikasi\Entities\Poster;
use Illuminate\Http\Response;

class PosterImport implements ToCollection, WithStartRow, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {    	
        foreach ($rows as $row) {
            if($row->filter()->isNotEmpty()){
                $poster = Poster::firstOrCreate([
                    'nama_peneliti' => $row['nama_peneliti'],
                    'judul_poster' => $row['judul_poster'],
                    'tahun' => $row['tahun'],
                    'acara_ilmiah' => $row['acara_ilmiah'],
                    'tanggal_acara_ilmiah' => $row['tanggal_acara_ilmiah'],
                    'publish' => 'Unpublish'
            ]);
          }
        }
    }

    public function headingRow(): int
    {
        return 3;
    }

    public function startRow(): int
    {
        return 4;
    }
}
