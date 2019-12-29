<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use UnexpectedValueException;

use function gettype;

class FloatQuery extends TypedQuery
{
    use TypedQueryTrait;
    
    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return float
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        if (!is_numeric($result)) {
            throw new UnexpectedValueException('Expected float, got "'. gettype($result) . '"');
        }

        return (float)$result;
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
