<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Webmozart\Assert\Assert;

use function gettype;

class IntQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @return int
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        Assert::integerish($result);

        return (int)$result;// The cast is needed because Doctrine may return numeric values
    }

    /**
     * @return int
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getIntResult()
    {
        return $this->getSingleScalarResult();
    }

    /**
     * @param string|int|null $hydrationMode
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = null)
    {
        return $this->getSingleScalarResult();
    }
}
