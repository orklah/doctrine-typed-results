<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\StringQuery;
use Doctrine\ORM\EntityManagerInterface;

class StringQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, 'string');
    }

    /**
     * @return StringQuery
     */
    public function getQuery()
    {
        return new StringQuery(parent::getQuery());
    }
}
