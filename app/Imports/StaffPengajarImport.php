<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Modules\TentangKami\Entities\StaffPengajar;
use Illuminate\Http\Response;

class StaffPengajarImport implements ToCollection, WithStartRow, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {    	
        foreach ($rows as $row) {
            if($row->filter()->isNotEmpty()) {
                $staff = StaffPengajar::firstOrCreate([
                    'nama_pengajar' => $row['nama_pengajar'] ?? '', 
                ], [
                    'divisi' => $row['divisi'] ?? '', 
                    'keterangan' => $row['keterangan'] ?? ''
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
