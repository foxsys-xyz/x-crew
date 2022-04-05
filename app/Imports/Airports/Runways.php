<?php

namespace App\Imports\Airports;

/**
 * Use Facades Required Additionally
 *
 */
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class Runways implements ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow, ShouldQueue
{
    use Importable;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            DB::table('runways')->insert([
                [
                    'icao' => $row['icao'],
                    'length' => $row['length'],
                    'width' => $row['width'],
                    'surface' => $row['surface'],
                    'lighted' => $row['lighted'],
                    'le_ident' => $row['le_ident'],
                    'le_elevation' => $row['le_elevation'],
                    'le_heading' => $row['le_heading'],
                    'he_ident' => $row['he_ident'],
                    'he_elevation' => $row['he_elevation'],
                    'he_heading' => $row['he_heading'],
                    'created_at' => Carbon::now('UTC'),
                    'updated_at' => Carbon::now('UTC'),
                ],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 1500;
    }

    public function chunkSize(): int
    {
        return 250;
    }
}
