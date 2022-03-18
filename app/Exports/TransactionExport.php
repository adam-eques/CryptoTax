<?php

namespace App\Exports;

use App\Models\CryptoTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CryptoTransaction::all();
    }
}
