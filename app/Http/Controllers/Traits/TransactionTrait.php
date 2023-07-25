<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait TransactionTrait {

    public function _transaction($commits, $returns, $rollback)
    {
        DB::beginTransaction();
        try {
            $commits();

            DB::commit();

            $returns();
        } catch (\Throwable $th) {

            DB::rollBack();
            $rollback();
        }
    }
}
