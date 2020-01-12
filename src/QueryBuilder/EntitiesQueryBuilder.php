<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use Doctrine\ORM\EntityManagerInterface;
use DoctrineTypedResults\Query\EntitiesQuery;

/**
 * @template Entity
 */
class EntitiesQueryBuilder extends TypedQueryBuilder
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
     * @return EntitiesQuery
     * @psalm-return EntitiesQuery<Entity>
     */
    public function getQuery()
    {
        return new EntitiesQuery($this->getQueryBuilder()->getQuery(), $this->type);
    }
}
