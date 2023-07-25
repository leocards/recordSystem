<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeRecord extends Model
{
    use HasFactory;

    protected $fill = [
        'record_id',
        'office_id'
    ];
}
