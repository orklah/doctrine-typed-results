<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\CustomQuery;

class CustomQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @return CustomQuery
     */
    public function getQuery()
    {
        return new CustomQuery(parent::getQuery(), $this->type);
    }
}
