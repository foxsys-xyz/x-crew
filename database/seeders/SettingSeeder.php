<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Use Facades Required Additionally
 *
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'realops',
            'status' => false,
            'created_at' => Carbon::now('UTC'),
            'updated_at' => Carbon::now('UTC'),
        ]);
    }
}
