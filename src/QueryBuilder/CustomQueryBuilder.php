<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\CustomQuery;
use Doctrine\ORM\EntityManagerInterface;

class CustomQueryBuilder extends TypedQueryBuilder
{
    use TypedQueryBuilderTrait;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em, string $type)
    {
        parent::__construct($em, $type);
        $this->type = $type;
    }

    /**
     * @return CustomQuery
     */
    public function getQuery()
    {
        return new CustomQuery(parent::getQuery());
    }
}
