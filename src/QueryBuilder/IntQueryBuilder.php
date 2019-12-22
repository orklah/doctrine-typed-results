<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\IntQuery;
use Doctrine\ORM\EntityManagerInterface;

class IntQueryBuilder extends TypedQueryBuilder
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, 'int');
    }
    
    /** @return IntQuery */
    public function getQuery()
    {
        return new IntQuery(parent::getQuery());
    }
    
}
