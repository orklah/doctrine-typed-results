<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\BoolQuery;
use Doctrine\ORM\EntityManagerInterface;

class BoolQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, 'bool');
    }

    /**
     * @return BoolQuery
     */
    public function getQuery()
    {
        return new BoolQuery(parent::getQuery());
    }
}
