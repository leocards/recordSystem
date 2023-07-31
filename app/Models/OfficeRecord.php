<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeRecord extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'record_id',
        'office_id',
        'Due'
    ];

    public function getOfficesTagged() {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function getOfficesRecords() {
        return $this->belongsTo(Record::class, 'record_id');
    }
}
