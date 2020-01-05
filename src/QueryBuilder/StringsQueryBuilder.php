<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\StringsQuery;

class StringsQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @return StringsQuery
     */
    public function getQuery()
    {
        return new StringsQuery($this->getQueryBuilder()->getQuery());
    }
}
