<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\FloatQuery;

class FloatQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @return FloatQuery
     */
    public function getQuery()
    {
        return new FloatQuery($this->getQueryBuilder()->getQuery());
    }
}
