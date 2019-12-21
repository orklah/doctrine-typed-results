<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

abstract class TypedQueryBuilder extends QueryBuilder
{
    /** @var bool */
    protected $isArray;
    /** @var string */
    protected $type;

    /**
     * @param EntityManagerInterface $em
     * @param string $type
     * @param bool $isArray
     */
    public function __construct(EntityManagerInterface $em, string $type, bool $isArray = false)
    {
        parent::__construct($em);
        $this->isArray = $isArray;
        $this->type = $type;
    }
}
