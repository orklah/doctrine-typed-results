<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\StringQuery;
use Doctrine\ORM\EntityManagerInterface;

class StringQueryBuilder extends TypedQueryBuilder
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, 'string');
    }

    /**
     * @return StringQuery
     */
    public function getQuery()
    {
        return new StringQuery(parent::getQuery());
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
        parent::andWhere(...func_get_args());
        return $this;
    }
    /**
     * @param mixed $where
     * @return static
     */
    public function orWhere()
    {
        parent::orWhere(...func_get_args());
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
}
