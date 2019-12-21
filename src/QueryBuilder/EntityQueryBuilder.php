<?php

declare(strict_types=1);

namespace DoctrineTypedResults\QueryBuilder;

use DoctrineTypedResults\Query\EntityQuery;
use Doctrine\ORM\EntityManagerInterface;

class EntityQueryBuilder extends TypedQueryBuilder
{
    /**
     * @param EntityManagerInterface $em
     * @param string $type
     */
    public function __construct(EntityManagerInterface $em, $type)
    {
        parent::__construct($em, $type);
    }
    
    /** @return EntityQuery */
    public function getQuery()
    {
        return new EntityQuery(parent::getQuery(), $this->type);
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
