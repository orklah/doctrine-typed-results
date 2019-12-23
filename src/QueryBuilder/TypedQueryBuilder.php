<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

abstract class TypedQueryBuilder extends QueryBuilder implements QueryBuilderInterface
{
    /** @var bool */
    protected $isArray;
    /** @var string */
    protected $type;

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}
