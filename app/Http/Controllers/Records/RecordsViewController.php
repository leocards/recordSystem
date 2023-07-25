<?php

namespace App\Http\Controllers\Records;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Traits\BreadCrumbsTrait;


class RecordsViewController extends Controller
{
    use BreadCrumbsTrait;

    static function open_record(Record $record) {
        $instance = new self();

        return Inertia::render('Record', [
            'records' => Record::where('parent', $record->id)->get(),
            'current' => $record,
            'crumbs' => $instance->crumbs($record)
        ]);

    }
}
