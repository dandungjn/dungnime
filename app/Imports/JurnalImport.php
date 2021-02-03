<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Modules\Publikasi\Entities\Jurnal;
use Illuminate\Http\Response;

class JurnalImport implements ToCollection, WithStartRow, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {    	
        foreach ($rows as $row) {
            if($row->filter()->isNotEmpty()){
                $cluster = Jurnal::firstOrCreate([
                    'year' => $row['year'],
                    'title' => $row['title'],
                    'author' => $row['author'],
                    'publisher' => $row['publisher'],
                    'publication_date' => $row['publication_date'],
                    'publish' => "Unpublish",
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
