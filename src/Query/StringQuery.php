<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use UnexpectedValueException;

use function gettype;
use function is_string;

class StringQuery extends TypedQuery
{
    use TypedQueryTrait;
    
    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return string
     */
    public function getSingleScalarResult()
    {
        $result = $this->query->getSingleScalarResult();
        if (!is_string($result)) {
            throw new UnexpectedValueException('Expected string, got "'. gettype($result) . '"');
        }

        return $result;
    }
}
