<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

use function gettype;

class StringQuery extends TypedQuery
{
    use TypedQueryTrait;
    
    /**
     * @return string
     * @throws AssertionFailedException
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        Assertion::string($result, 'Expected string, got "'. gettype($result) . '"');

        return $result;
    }

    /**
     * @return string
     * @throws AssertionFailedException
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getBoolResult()
    {
        return $this->getSingleScalarResult();
    }

    /**
     * @param string|int|null $hydrationMode
     * @return string
     * @throws AssertionFailedException
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = null)
    {
        return $this->getSingleScalarResult();
    }
}
