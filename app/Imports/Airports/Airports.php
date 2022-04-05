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

class Airports implements ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow, ShouldQueue
{
    use Importable;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            DB::table('airports')->insert([
                [
                    'icao' => $row['icao'],
                    'iata' => $row['iata'],
                    'airport_name' => $row['airport_name'],
                    'city_name' => $row['city_name'],
                    'country' => $row['country'],
                    'continent' => $row['continent'],
                    'elevation' => $row['elevation'],
                    'lat' => $row['lat'],
                    'lng' => $row['lng'],
                    'hub' => $row['hub'],
                    'created_at' => Carbon::now('UTC'),
                    'updated_at' => Carbon::now('UTC'),
                ],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 3000;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
