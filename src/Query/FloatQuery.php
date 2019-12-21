<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;

class FloatQuery extends TypedQuery
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
     * @return float
     */
    public function getSingleScalarResult()
    {
        assert(is_numeric($this->query->getSingleScalarResult()));

        return (float)$this->query->getSingleScalarResult();
    }

    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return float
     */
    public function getFloatResult()
    {
        return $this->getSingleScalarResult();
    }
}
