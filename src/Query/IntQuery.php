<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use UnexpectedValueException;

class IntQuery extends TypedQuery
{
    use TypedQueryTrait;
    
    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return int
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        if (!is_numeric($result)) {
            throw new UnexpectedValueException('Expected int, got "'. $result . '"');
        }

        return (int)$result;
    }

    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return int
     */
    public function getIntResult()
    {
        return $this->getSingleScalarResult();
    }
}
