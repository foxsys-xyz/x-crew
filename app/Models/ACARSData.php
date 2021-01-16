<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ACARSData extends Model
{
    use HasFactory;

    /**
     * Assign ACARS Data Table to Model.
     *
     */
    protected $table = 'acars_data';
}
