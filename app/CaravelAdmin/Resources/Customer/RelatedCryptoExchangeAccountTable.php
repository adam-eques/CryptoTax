<?php

namespace App\CaravelAdmin\Resources\Customer;

use App\CaravelAdmin\Resources\CryptoExchangeAccount\CryptoExchangeAccountTable;
use WebCaravel\Admin\Resources\RelatedTableFieldTrait;

class RelatedCryptoExchangeAccountTable extends CryptoExchangeAccountTable
{
    use RelatedTableFieldTrait;
}
