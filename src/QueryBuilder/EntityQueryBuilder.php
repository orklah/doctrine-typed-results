<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\EntityQuery;
use Doctrine\ORM\EntityManagerInterface;

class EntityQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @param EntityManagerInterface $em
     * @param string $type
     */
    public function __construct(EntityManagerInterface $em, $type)
    {
        parent::__construct($em, $type);
    }
    
    /** @return EntityQuery */
    public function getQuery()
    {
        return new EntityQuery(parent::getQuery(), $this->type);
    }

}
