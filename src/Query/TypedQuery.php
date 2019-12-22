<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\Query;

abstract class TypedQuery
{
    /**
     * @var Query
     */
    protected $query;

    /**
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * @return Query
     */
    public function get()
    {
        return $this->query;
    }

    /**
     * @param int $maxResults
     * @return static
     */
    public function setMaxResults(int $maxResults)
    {
        $this->query->setMaxResults($maxResults);
        return $this;
    }

    /**
     * @param int $firstResult
     * @return static
     */
    public function setFirstResult(int $firstResult)
    {
        $this->query->setFirstResult($firstResult);
        return $this;
    }
}
