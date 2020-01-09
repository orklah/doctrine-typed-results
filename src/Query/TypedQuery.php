<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;

abstract class TypedQuery extends AbstractQuery implements QueryInterface
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
        parent::__construct($query->getEntityManager());
        $this->query = $query;
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Alias of getQuery
     */
    public function get()
    {
        return $this->getQuery();
    }
}
