<?php

namespace App\Imports\Airports;

/**
 * Use Facades Required Additionally
 *
 */

use App\Models\Airport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportAirports implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Airport|null
    */
    public function model(array $row)
    {
        return new Airport([
            'icao' => $row['icao'],
            'iata' => $row['iata'],
            'airport_name' => $row['airport_name'],
            'city_name' => $row['city_name'],
            'country' => $row['country'],
            'continent' => $row['continent'],
            'elevation' => $row['elevation'],
            'lat' => $row['lat'],
            'lng' => $row['lng'],
            'hub' => $row['hub']
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
