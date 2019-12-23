<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use UnexpectedValueException;

class BoolQuery extends TypedQuery
{
    use TypedQueryTrait;
    
    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return bool
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        if (!\is_bool($result)) {
            throw new UnexpectedValueException('Expected bool, got "'. $result . '"');
        }

        return $result;
    }
}
