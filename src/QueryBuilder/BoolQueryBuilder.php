<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use Doctrine\ORM\Query\Expr;
use DoctrineTypedResults\Query\BoolQuery;
use Doctrine\ORM\EntityManagerInterface;
use DoctrineTypedResults\Query\EntityQuery;

class BoolQueryBuilder extends TypedQueryBuilder
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, 'bool');
    }

    /**
     * @return BoolQuery
     */
    public function getQuery()
    {
        return new BoolQuery(parent::getQuery());
    }

    /**
     * @param mixed|null $select
     * @return static
     */
    public function select($select = null)
    {
        parent::select($select);
        return $this;
    }
    
    /**
     * @param mixed|null $select
     * @return static
     */
    public function addSelect($select = null)
    {
        parent::addSelect($select);
        return $this;
    }
    /** @return static */
    public function from($from, $alias, $indexBy = null)
    {
        parent::from($from, $alias, $indexBy);
        return $this;
    }
    /** @return static */
    public function where($predicates)
    {
        parent::where($predicates);
        return $this;
    }
    /**
     * @param mixed $where
     * @return static 
     */
    public function andWhere()
    {
        $args = func_get_args(); // Local variable to help PSALM detect func_get_args
        parent::andWhere(...$args);
        return $this;
    }
    /**
     * @param mixed $where 
     * @return static 
     */
    public function orWhere()
    {
        $args = func_get_args(); // Local variable to help PSALM detect func_get_args
        parent::orWhere(...$args);
        return $this;
    }
    /** @return static */
    public function having($having)
    {
        parent::having($having);
        return $this;
    }
    /** @return static */
    public function andHaving($having)
    {
        parent::andHaving($having);
        return $this;
    }
    /** @return static */
    public function orHaving($having)
    {
        parent::orHaving($having);
        return $this;
    }

    /**
     * @param string|Expr\OrderBy $sort The ordering expression.
     * @param string $order The ordering direction.
     *
     * @return static
     */
    public function orderBy($sort, string $order = null)
    {
        parent::orderBy($sort, $order);

        return $this;
    }
    
    /**
     * @param int $maxResults
     * @return static
     */
    public function setMaxResults(int $maxResults)
    {
        parent::setMaxResults($maxResults);
        return $this;
    }

    /**
     * @param int $firstResult
     * @return static
     */
    public function setFirstResult(int $firstResult)
    {
        parent::setFirstResult($firstResult);
        return $this;
    }
}
