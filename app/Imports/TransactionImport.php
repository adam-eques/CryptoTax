<?php

namespace App\Imports;

use App\Models\CryptoTransaction;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CryptoTransaction([
            //
        ]);
    }
}
