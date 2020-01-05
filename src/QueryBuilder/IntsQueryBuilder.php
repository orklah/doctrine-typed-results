<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\IntsQuery;

class IntsQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /** @return IntsQuery */
    public function getQuery()
    {
        return new IntsQuery($this->getQueryBuilder()->getQuery());
    }
}
