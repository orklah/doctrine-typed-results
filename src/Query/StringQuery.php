<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Webmozart\Assert\Assert;

use function gettype;

class StringQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @return string
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        Assert::string($result);

        return $result;
    }

    /**
     * @return string
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
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSingleResult($hydrationMode = null)
    {
        return $this->getSingleScalarResult();
    }
}
