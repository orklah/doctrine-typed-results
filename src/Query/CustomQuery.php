<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;

class CustomQuery extends TypedQuery
{
    use TypedQueryTrait;
    
    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return string
     */
    public function getSingleScalarResult()
    {
        die('todo');
    }
}
