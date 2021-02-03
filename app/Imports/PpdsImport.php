<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Modules\TentangKami\Entities\Ppds;
use Illuminate\Http\Response;

class PpdsImport implements ToCollection, WithStartRow, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {    	
        foreach ($rows as $row) {
            if($row->filter()->isNotEmpty()) {
                $staff = Ppds::firstOrCreate([
                    'nama_ppds' => $row['nama_ppds'] ?? '', 
                ], [
                    'tanggal_masuk' => $row['tanggal_masuk'] ? \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_masuk'])) : null, 
                    'deskripsi' => $row['deskripsi'] ?? ''
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
