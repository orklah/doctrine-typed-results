<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\BoolQuery;

class BoolQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @return BoolQuery
     */
    public function getQuery()
    {
        return new BoolQuery(parent::getQuery());
    }
}
