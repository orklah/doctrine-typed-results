<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;

class BoolQuery extends TypedQuery
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
     * @return bool
     */
    public function getSingleScalarResult()
    {
        assert(is_bool($this->query->getSingleScalarResult()));

        return $this->query->getSingleScalarResult();
    }
}
