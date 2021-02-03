<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Modules\Penelitian\Entities\DaftarPenelitian;
use Illuminate\Http\Response;

class DaftarPenelitianImport implements ToCollection, WithStartRow, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {    	
        foreach ($rows as $row) {
            if($row->filter()->isNotEmpty()){
                $cluster = DaftarPenelitian::firstOrCreate([
                    'kategori' => $row['kategori'],
                    'judul' => $row['judul'],
                    'penulis' => $row['penulis'],
                    'pembimbing' => $row['pembimbing'],
                    'publish' => "Unpublish"
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
