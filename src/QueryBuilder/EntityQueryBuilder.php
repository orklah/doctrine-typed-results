<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\EntityQuery;

/**
 * @template T
 */
class EntityQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @return EntityQuery
     * @psalm-return EntityQuery<T>
     */
    public function getQuery()
    {
        return new EntityQuery(parent::getQuery(), $this->type);
    }
}
