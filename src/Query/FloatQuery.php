<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

use function gettype;

class FloatQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @return float
     * @throws AssertionFailedException
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        Assertion::numeric($result, 'Expected float, got "'. gettype($result) . '"');

        return (float)$result;// The cast is needed because Doctrine may return numeric values
    }

    /**
     * @return float
     * @throws AssertionFailedException
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getFloatResult()
    {
        return $this->getSingleScalarResult();
    }

    /**
     * @param null $hydrationMode
     * @return float
     * @throws AssertionFailedException
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = null)
    {
        return $this->getSingleScalarResult();
    }
}
