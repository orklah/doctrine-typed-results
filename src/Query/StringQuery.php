<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;

class StringQuery extends TypedQuery
{
    /**
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        parent::__construct($query);
    }

    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return string
     */
    public function getSingleScalarResult()
    {
        assert(is_string($this->query->getSingleScalarResult()));

        return $this->query->getSingleScalarResult();
    }
}
