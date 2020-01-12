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
     * @param Query $query For testability reasons, we have to accept AbstractQuery
     *                     But the real type has to be a Query
     */
    public function __construct(AbstractQuery $query)
    {
        parent::__construct($query->getEntityManager());
        $this->query = $query;
    }

    public function getQuery(): Query
    {
        return $this->query;
    }

    /**
     * Alias of getQuery
     */
    public function get(): Query
    {
        return $this->getQuery();
    }
}
