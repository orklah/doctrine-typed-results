<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

use function gettype;

class IntQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @return int
     * @throws AssertionFailedException
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        Assertion::integerish($result, 'Expected int, got "'. gettype($result) . '"');

        return (int)$result;// The cast is needed because Doctrine may return numeric values
    }

    /**
     * @return int
     * @throws AssertionFailedException
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getIntResult()
    {
        return $this->getSingleScalarResult();
    }

    /**
     * @param null $hydrationMode
     * @return int
     * @throws AssertionFailedException
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = null)
    {
        return $this->getSingleScalarResult();
    }
}
