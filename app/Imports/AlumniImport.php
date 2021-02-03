<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Modules\TentangKami\Entities\ListAlumni;
use Modules\TentangKami\Entities\Alumni;
use Illuminate\Http\Response;

class AlumniImport implements ToCollection, WithStartRow, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {    	
        foreach ($rows as $row) {
            if($row->filter()->isNotEmpty()) {
                if ($row['tahun_lulus']) {
                    $tahun_lulus = Alumni::where('tahun_lulus', $row['tahun_lulus'])->first();
                    if ($tahun_lulus) {
                        $staff = ListAlumni::firstOrCreate([
                            'id_alumni' => $tahun_lulus->id, 
                            'nama_alumni' => $row['nama_alumni'], 
                        ], [
                            'divisi' => $row['divisi'] ?? '', 
                            'deskripsi' => $row['deskripsi'] ?? ''
                        ]);
                    } else {
                        $tahun = Alumni::firstOrCreate([
                            'tahun_lulus' => $row['tahun_lulus'], 
                        ], [
                            'deskripsi' => $row['nama_alumni'], 
                        ]);

                        $staff = ListAlumni::firstOrCreate([
                            'id_alumni' => $tahun->id, 
                            'nama_alumni' => $row['nama_alumni'], 
                        ], [
                            'divisi' => $row['divisi'] ?? '', 
                            'deskripsi' => $row['deskripsi'] ?? ''
                        ]);
                    }
                }
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
