<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use Doctrine\ORM\EntityManagerInterface;
use DoctrineTypedResults\Query\EntityQuery;

/**
 * @template Entity of object
 */
class EntityQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @psalm-var class-string<Entity>
     * @var string
     */
    protected $type;

    /**
     * @psalm-param class-string<Entity> $type
     * @param EntityManagerInterface $em
     * @param string $type
     */
    public function __construct(EntityManagerInterface $em, $type)
    {
        parent::__construct($em);
        $this->type = $type;
    }

    /**
     * @return EntityQuery
     * @psalm-return EntityQuery<Entity>
     */
    public function getQuery()
    {
        return new EntityQuery($this->getQueryBuilder()->getQuery(), $this->type);
    }
}
