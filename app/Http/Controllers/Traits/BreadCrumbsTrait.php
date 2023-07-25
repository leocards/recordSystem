<?php
namespace App\Http\Controllers\Traits;

use App\Models\Record;

trait BreadCrumbsTrait {

    public function crumbs(Record $record)
    {
        try {
            $crumbs = collect([]);
            while ($record->parent != null) {
                $record = Record::find($record->parent);
                $crumbs->prepend($record->only(['id', 'name']));
            }

            return $crumbs;
        } catch (\Throwable $th) {
            //dd($th->getMessage());
            return null;
        }
    }
}
