<?php

namespace App\CaravelAdmin\Resources\Customer;

use WebCaravel\Admin\Resources\RelatedTableFieldTrait;

class RelatedRecruitedUserTable extends CustomerTable
{
    use RelatedTableFieldTrait;


    public function bootRelatedTableFieldTrait()
    {
        $this->extraQueries[] = function($query) {
            return $query->whereHas("userAffiliate", function ($query){
                $query->where("recruited_by", $this->relatedRecord->id);
            });
        };
    }
}
