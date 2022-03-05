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

class Frequencies implements ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow, ShouldQueue
{
    use Importable;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            DB::table('frequencies')->insert([
                [
                    'icao' => $row['icao'],
                    'type' => $row['type'],
                    'description' => $row['description'],
                    'frequency' => $row['frequency'],
                    'created_at' => Carbon::now('UTC'),
                    'updated_at' => Carbon::now('UTC')
                ]
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
