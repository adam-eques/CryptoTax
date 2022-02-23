<?php

namespace App\CaravelAdmin\Resources\Customer;

use App\CaravelAdmin\Resources\UserCreditLog\UserCreditLogTable;
use WebCaravel\Admin\Resources\RelatedTableFieldTrait;

class RelatedUserCreditLogTable extends UserCreditLogTable
{
    use RelatedTableFieldTrait;
}
