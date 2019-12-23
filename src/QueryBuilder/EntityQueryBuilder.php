<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\EntityQuery;

class EntityQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /** @return EntityQuery */
    public function getQuery()
    {
        return new EntityQuery(parent::getQuery(), $this->type);
    }
}
