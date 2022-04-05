<?php

namespace App\Imports;

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

class Aircraft implements ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow, ShouldQueue
{
    use Importable;

    protected $location;

    /**
     * Transfer location instance.
     *
     * @return void
     */
    public function __construct($location)
    {
        $this->location = $location;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        if ($this->location == null) {
            $getHub = DB::table('airports')->where('hub', true)->inRandomOrder()->first();
            $acLocation = $getHub->icao;
        } else {
            $acLocation = $this->location;
        }

        foreach ($rows as $row) 
        {
            DB::table('aircraft')->insert([
                [
                    'icao' => $row['icao'],
                    'manufacturer' => $row['manufacturer'],
                    'model' => $row['model'],
                    'airline_icao' => $row['airline_icao'],
                    'registration' => $row['registration'],
                    'range' => $row['range'],
                    'mtow' => $row['mtow'],
                    'cruise' => $row['cruise'],
                    'maxpax' => $row['maxpax'],
                    'maxcargo' => $row['maxcargo'],
                    'location' => $acLocation,
                    'created_at' => Carbon::now('UTC'),
                    'updated_at' => Carbon::now('UTC')
                ]
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
