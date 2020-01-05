<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

abstract class TypedQueryBuilder implements QueryBuilderInterface
{
    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    public function __construct(EntityManagerInterface $em)
    {
        $this->queryBuilder = new QueryBuilder($em);
    }
    
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }
}
