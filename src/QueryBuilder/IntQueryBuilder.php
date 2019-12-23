<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\IntQuery;

class IntQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /** @return IntQuery */
    public function getQuery()
    {
        return new IntQuery(parent::getQuery());
    }
}
