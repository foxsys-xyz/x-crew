<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PIREP extends Model
{
    use HasFactory;

    /**
     * Assign PIREPS Table to Model.
     *
     */
    protected $table = 'pireps';
}
