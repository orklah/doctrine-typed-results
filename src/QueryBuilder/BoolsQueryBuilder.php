<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\BoolsQuery;

class BoolsQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @return BoolsQuery
     */
    public function getQuery()
    {
        return new BoolsQuery($this->getQueryBuilder()->getQuery());
    }
}
