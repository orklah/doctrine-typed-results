<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\StringQuery;

class StringQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @return StringQuery
     */
    public function getQuery()
    {
        return new StringQuery($this->getQueryBuilder()->getQuery());
    }
}
