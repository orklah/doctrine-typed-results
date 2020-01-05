<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\FloatsQuery;

class FloatsQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @return FloatsQuery
     */
    public function getQuery()
    {
        return new FloatsQuery($this->getQueryBuilder()->getQuery());
    }
}
