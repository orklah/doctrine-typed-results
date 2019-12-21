<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;

class EntityQuery extends TypedQuery
{
    /** @var string */
    private $type;

    /**
     * @param string $type
     * @param Query $query
     */
    public function __construct(Query $query, $type)
    {
        parent::__construct($query);
        $this->type = $type;
    }

    /**
     * @throws NoResultException
     * @throws NonUniqueResultException
     *
     * @return string
     */
    public function getSingleScalarResult()
    {
        die('todo');
    }


    /**
     * @param int $maxResults
     * @return EntityQuery
     */
    public function setMaxResults(int $maxResults)
    {
        $this->query->setMaxResults($maxResults);
        return $this;
    }

    /**
     * @param int $firstResult
     * @return EntityQuery
     */
    public function setFirstResult(int $firstResult)
    {
        $this->query->setFirstResult($firstResult);
        return $this;
    }
}
