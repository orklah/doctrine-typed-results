<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\FloatQuery;
use Doctrine\ORM\EntityManagerInterface;

class FloatQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, 'float');
    }

    /**
     * @return FloatQuery
     */
    public function getQuery()
    {
        return new FloatQuery(parent::getQuery());
    }

}
