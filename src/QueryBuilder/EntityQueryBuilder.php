<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\EntityQuery;

/**
 * @template Entity
 */
class EntityQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @phpstan-var class-string<Entity>
     * @psalm-var class-string<Entity>
     * @var string
     */
    protected $type;
    
    /**
     * @return EntityQuery
     * @psalm-return EntityQuery<Entity>
     */
    public function getQuery()
    {
        return new EntityQuery(parent::getQuery(), $this->type);
    }


    /**
     * @phpstan-param class-string<Entity> $type
     * @psalm-param class-string<Entity> $type
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
