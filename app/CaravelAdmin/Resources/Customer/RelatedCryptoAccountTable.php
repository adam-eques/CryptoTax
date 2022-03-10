<?php

namespace App\CaravelAdmin\Resources\Customer;

use App\CaravelAdmin\Resources\CryptoAccount\CryptoAccountTable;
use WebCaravel\Admin\Resources\RelatedTableFieldTrait;

class RelatedCryptoAccountTable extends CryptoAccountTable
{
    use RelatedTableFieldTrait;
}
