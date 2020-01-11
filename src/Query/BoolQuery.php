<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Webmozart\Assert\Assert;

use function gettype;

class BoolQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @return bool
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        Assert::boolean($result, 'Expected bool, got "'. gettype($result) . '"');

        return $result;
    }

    /**
     * @return bool
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getBoolResult()
    {
        return $this->getSingleScalarResult();
    }

    /**
     * @param string|int|null $hydrationMode
     * @return bool
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = null)
    {
        return $this->getSingleScalarResult();
    }
}
